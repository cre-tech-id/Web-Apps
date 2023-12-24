const flashdata = $('.flash-data').data('flashdata');
if (flashdata){
  Swal.fire({
    icon: 'success',
    title: flashdata
  })
}

const flashdata_error = $('.flash-error').data('flashdata');
if (flashdata_error){
  Swal.fire({
    icon: 'error',
    title: flashdata_error
  })
}

const flashdata_info = $('.flash-info').data('flashdata');
if (flashdata_info){
  Swal.fire({
    icon: 'info',
    title: flashdata_info
  })
}
