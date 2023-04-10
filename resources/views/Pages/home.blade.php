
<style>
    .btnh {
  border: none;

  opacity: 0.8;
  transition: 0.3s;
}

.btnh:hover {
    opacity: 5;
    background-color:rgb(80, 167, 214);
    }
.font-fh{
    font-family: 'Fasthand', cursive;
    font-size: 25px;
}

</style>
<livewire:home>
    @section('script')
    <script>
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
        });

        $(document).ready(function() {
        $("#success-alert").hide();
        $("#myWish").click(function showAlert() {
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
            });
        });
        });

//         $(document).ready(function() {
//    $('.js-example-basic-multiple1').select2({
//        placeholder: "Select any of the following"
//    });
//    });
    </script>
    @endsection
