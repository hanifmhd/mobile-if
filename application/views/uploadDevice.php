<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
<div class="my-form-challenge">
<?php echo form_open_multipart('home/adminDevice/upload/');?>
<p>Ukuran 766 x 500 pixel</p>

<input class="form-control" type="text" name="name" value="<?=$model?>" readonly>

<input type="file" name="userfile" size="20" id="imageId" onchange="return ValidateFileUpload()"/>

<br /><br />

<button type="submit" class="btn btn-primary" name="submit" value="upload" >Unggah</button>

</form>
</div>
</div>


<SCRIPT type="text/javascript">
    function ValidateFileUpload() {
        var fuData = document.getElementById('imageId');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            alert("Tolong unggah foto.");

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "jpg") {

// To Display
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            } 

//The file upload is NOT an image
else {
                alert("Tipe foto yang diperbolehkan hanya JPG. ");

            }

            var width = fuData.clientWidth;
			var height = fuData.clientHeight;
			if (width != 766 && height != 500) {
				window.alert('Maaf ukuran gambar yang Anda akan unggah tidak sesuai ketentuan.\nHarap dirubah terlebih dahulu.\n\nTerima Kasih.');
			}
        }
    }
</SCRIPT>
