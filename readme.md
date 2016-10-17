# Download
1. Download the SubconsciousSketches' coloring page from https://drive.google.com/file/d/0B5RUUU-GbzT2OFpmNzJXd2lOZFU/view
1. Copy the git repo `git clone https://github.com/snoj/subconscioussketches-colorize`

# Run
Note that both scripts assumes that ColoringPage06.jpg exists in the same directory. Colorize.php assumes that ./fix-blackwhite.php has been run.
```
# first fix the image so there are only black and white pixels
./fix-blackwhite.php

# now flood fill
./colorize.php
```

# Notices
Code is MIT

Coloring page belongs to Michael Bregel or SubconsciousSketches. Not sure which and since he wanted people to try it out, I don't really care what the copyright is. 

# License
Copyright (c) 2016 Joshua Erickson

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.