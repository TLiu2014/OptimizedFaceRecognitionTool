#!/usr/bin/env python
import sys
sys.path.append('/Library/Python/2.7/site-packages/')
sys.path.append('usr/local/lib/python2.7/site-packages/')
from PIL import Image, ImageDraw
#import numpy as np
#from skimage import exposure, img_as_float
import os

def main():
    '''
    img = Image.open("/Applications/MAMP/htdocs/yhack2015/input.jpg")
    im = np.asarray(img)
    here = os.getcwd()
    gamma_corrected_dark = exposure.adjust_gamma(im, 2.0)
    gamma_corrected_bright = exposure.adjust_gamma(im, 0.5)
    img = Image.fromarray(np.uint8(gamma_corrected_dark))
    #img.save(os.path.join(here, "output_dark.jpg"), "JPEG")
    img.save("/Applications/MAMP/htdocs/yhack2015/output_dark.jpg", "JPEG")
    #img = Image.fromarray(np.uint8(gamma_corrected_bright))
    #img.save("output_bright.jpg", "JPEG")
    '''
    print "Done!"

if __name__ == "__main__":
    main()





