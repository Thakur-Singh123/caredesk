//SweetAlert
document.addEventListener('DOMContentLoaded', function () {
    // 1. Live image preview logic
    const accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.getElementById('upload');

    if (fileInput) {
        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                accountUserImage.src = URL.createObjectURL(file);
            }
        });
    }
    //SweetAlert Delete Confirmation logic
    const deleteBtn = document.querySelector('.delete-btn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete your profile image?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#7367f0', // Primary action color
                cancelButtonColor: '#ff4c51',  // Sneat theme danger/red color for cancel
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'btn btn-primary me-3',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    }
});