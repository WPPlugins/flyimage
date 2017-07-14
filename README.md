# Get the perfect image size at any given point in your theme!
flyimage allows you to specify the image size you would like to receive in your Themes HTML!
The file will automatically be created on a first visit. Further visits will use the already created file.
Cached images will be stored in your uploads Directory (usually wp-content/uploads/fly/)

## Single Image

**flyImage($attachmentId / $attachmentUrl, $width, $height)**

Example: Image with a width of 200px

`<img src="{{ flyImage(1, 200) }}" />`


Example: Image width a width of 300px and a height of 200px (cropped)

`<img src="{{ flyImage(1, 300, 200) }}" />`


Example: Image width a width of 300px and a height of 200px (uncropped)

`<img src="{{ flyImage(1, 300, 200, false) }}" />`


## Get a full SourceSet

**flyImageSourceSet($attachmentId / $attachmentUrl, [$width1, $width2, ...])**

Example: Sizes: 400px, 800px and 1200px (width):

`<img srcset="{{ flyImageSourceSet(1, [400, 800, 1200]) }}" />`
