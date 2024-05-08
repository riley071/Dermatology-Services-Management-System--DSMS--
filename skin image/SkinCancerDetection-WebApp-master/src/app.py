# Importing necessary libraries and modules
from __future__ import division, print_function
import sys
import os
import glob
import re
from pathlib import Path
from io import BytesIO
import base64
import requests

# Importing fast.ai Library
# The fastai library is used for deep learning tasks in this code. Specifically, it is used for image classification tasks.
from fastai import *  # Importing all modules from the fastai library
from fastai.vision import *  # Importing the vision module from the fastai library
from fastai.vision.data import ImageDataBunch  # Importing the ImageDataBunch class from the fastai library

# Importing Flask utilities
from flask import Flask, redirect, url_for, render_template, request  # Importing Flask modules for web application development
from PIL import Image as PILImage  # Importing the Image class from the PIL library for image processing

# Importing Path class from pathlib module
from pathlib import Path

# Define a Flask app instance
app = Flask(__name__)  # Creating a Flask app instance with the name of the current module

# Setting up file paths and class labels
NAME_OF_FILE = 'model_best'  # Defining the name of the exported model file
PATH_TO_MODELS_DIR = Path('C:/Users/riley/Downloads/SkinCancerDetection-WebApp-master/models')  # Defining the path to the models directory
classes = ['Actinic keratoses', 'Basal cell carcinoma', 'Benign keratosis',  # Defining a list of skin condition classes
           'Dermatofibroma', 'Melanocytic nevi', 'Melanoma', 'Vascular lesions']

# Function to set up the PyTorch modelcd 
def setup_model_pth(path_to_pth_file, learner_name_to_load, classes):
    # Setting up the data for the model
    data = ImageDataBunch.single_from_classes(
        path_to_pth_file.parent, classes, ds_tfms=get_transforms(), size=224).normalize(imagenet_stats)
    # Creating a learner object with the specified data and model architecture
    learn = cnn_learner(data, models.densenet169, model_dir=str(path_to_pth_file.parent))
    # Loading the pre-trained model weights and architecture
    learn.load(learner_name_to_load, device=torch.device('cpu'))
    return learn  # Returning the loaded learner object

# Loading the PyTorch model
learn = setup_model_pth(PATH_TO_MODELS_DIR, NAME_OF_FILE, classes)  # Calling the setup_model_pth function to load the model

# Function to encode images to base64 format
def encode(img):
    # Converting the image data to a numpy array and then to an 8-bit unsigned integer array
    img = (image2np(img.data) * 255).astype('uint8')
    # Creating a PIL Image object from the numpy array
    pil_img = PILImage.fromarray(img)
    # Creating a BytesIO object to store binary data
    buff = BytesIO()
    # Saving the PIL Image to the BytesIO object in JPEG format
    pil_img.save(buff, format="JPEG")
    # Encoding the binary data to base64 format and decoding it to UTF-8 format
    return base64.b64encode(buff.getvalue()).decode("utf-8")

# Function to make predictions using the model
def model_predict(img):
    # Opening the image file and converting it to an Image object
    img = open_image(BytesIO(img))
    # Making predictions using the loaded model
    pred_class,pred_idx,outputs = learn.predict(img)
    # Formatting the prediction probabilities
    formatted_outputs = ["{:.1f}%".format(value) for value in [x * 100 for x in torch.nn.functional.softmax(outputs, dim=0)]]
    # Sorting the predicted probabilities and class labels
    pred_probs = sorted(
            zip(learn.data.classes, map(str, formatted_outputs)),
            key=lambda p: p[1],
            reverse=True
        )

    # Encoding the image to base64 format
    img_data = encode(img)
    # Creating a dictionary containing the predicted class, probabilities, and base64-encoded image
    result = {"class":pred_class, "probs":pred_probs, "image":img_data}
    # Rendering the result template with the prediction details
    return render_template('result.html', result=result)

# Route for the main page
@app.route('/', methods=['GET', "POST"])
def index():
    # Rendering the index.html template for the main page
    return render_template('index.html')

# Route for uploading images and making predictions
@app.route('/upload', methods=["POST", "GET"])
def upload():
    if request.method == 'POST':
        img = request.files['file'].read()  # Retrieving the uploaded image file
        if img != None:
            preds = model_predict(img)  # Making predictions using the model
            return preds  # Returning the prediction results
    return 'OK'  # Returning 'OK' if no image is uploaded

# Starting the Flask app
if __name__ == '__main__':
    port = os.environ.get('PORT', 8008)  # Getting the port from the environment variables or using default port 8008

    if "prepare" not in sys.argv:
        app.run(debug=False, host='0.0.0.0', port=port)  # Running the Flask app on the specified host and port
