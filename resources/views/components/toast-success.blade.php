<div>
    <span x-show="
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    iconColor: 'white',
    customClass: {
        popup: 'colored-toast',
    },
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    background: '#a5dc86'
    })

    Toast.fire({
        icon: 'success',
        text: '{{session('success')}}'
    })
">
</span>
</div>
