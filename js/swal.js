
function login(){
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
      })
   setTimeout(()=>{
    window.location.href='mainboard.php'
   },1900)
}
