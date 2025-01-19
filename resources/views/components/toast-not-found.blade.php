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
    background: '#f27474'
    })

    Toast.fire({
        icon: 'error',
        text: '{{session('notFound')}}',
    })
">
</span>
</div>
