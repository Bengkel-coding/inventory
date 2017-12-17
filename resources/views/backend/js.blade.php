@push('scripts')
<script type="text/javascript">
	function readURL(input,image_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#'+image_id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
       $("#"+image_id).show();
       $("#div_" + image_id).show();
       
  }

  function readFile(input,image_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#'+image_id).attr('src', '{{ asset('pdf.png') }}');
            }
            reader.readAsDataURL(input.files[0]);
        }
      
       $("#div_" + image_id).show();
       
  }

  function hide_image(model,id,name)
  {
      $("#" + name).val("");
      $("#image_" + name).attr('src','');
      $("#div_image_" + name).hide();
      $.ajax({
        url : '{{ urlBackend("delete-image") }}',
        data : {
          paramModel : model,
          id : id ,
          name : name,
        },
      });
  }

  	$(document).ready(function(){
  		$("#datepicker").datepicker({
  			dateFormat : 'yy-mm-dd',
  			changeMonth: true,
      		changeYear: true,
  		});
  	});

</script>
@endpush