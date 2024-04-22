<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Product with Images</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .preview-images-zone {
                width: 100%;
                border: 1px solid #ddd;
                min-height: 180px;
                border-radius: 5px;
                padding: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
                box-sizing: border-box;
            }

            .preview-images-zone .preview-image {
                width: 200px;
                height: 180px;
                position: relative;
                margin: 10px;
            }

            .preview-images-zone .preview-image .delete-button {
                position: absolute;
                top: 0;
                right: 0;
                cursor: pointer;
                width: 25px;
                height: 25px;
                background-color: #333;
                color: #fff;
                border-radius: 50%;
                text-align: center;
                line-height: 25px;
            }
        </style>
    </head>

    <body>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Upload Product with Images</div>

                        <div class="card-body">
                            <form id="productForm" action="{{ route('createProduct') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="number" name="price" id="price" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Product Description</label>
                                    <textarea name="description" id="description" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="images">Product Images (Max: 2048 KB)</label>
                                    <input type="file" name="images[]" id="images" class="form-control-file"
                                        multiple required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                            <div class="preview-images-zone">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('images').addEventListener('change', function() {
                var files = document.getElementById('images').files;
                for (var i = 0; i < files.length; i++) {
                    previewImage(this.files[i]);
                }
            });

            function previewImage(file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var html = `
                <div class="preview-image">
                    <img src="${event.target.result}" alt="${file.name}" style="width:100%;height:100%;">
                    <span class="delete-button" onclick="removeImage(this)">X</span>
                </div>`;
                    document.querySelector('.preview-images-zone').insertAdjacentHTML('beforeend', html);
                }
                reader.readAsDataURL(file);
            }

            function removeImage(element) {
                element.parentElement.remove();
            }
        </script>
    </body>

</html>
