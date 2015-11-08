
from PIL import Image, ImageDraw
import numpy as np
import sys, json
import os
def main(argv):
    if len(argv)!=3:
        print "Arguments error!"
        return str(len(argv))
    else:
       input_json = argv[1]
       input_img = argv[2]

    faces = json.loads(input_json)
    im = Image.open(input_img)
    draw = ImageDraw.Draw(im)
    
    for face in faces:
        draw.rectangle([int(face['left']), int(face['top']), (int(face['left'])+int(face['width'])), (int(face['top'])+int(face['height']))], outline = "red")
        draw.rectangle([int(face['left'])+1, int(face['top'])+1, (int(face['left'])+int(face['width'])-1), (int(face['top'])+int(face['height'])-1)], outline = "red")
    
    #basedir = os.path.abspath(os.path.dirname(__file__))
    #file_path = os.path.join(basedir, "output.jpg")
    #im.save(file_path, "JPEG")
    im.save(input_img, "JPEG")
    print input_json
    return input_json
    
if __name__ == "__main__":
    main(sys.argv)





