document.addEventListener('DOMContentLoaded', function () {
    let deleteModal = document.getElementById('deleteModal')
    let confirmDeleteBtn = document.getElementById('confirmDelete')
    deleteModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget
        let url = button.getAttribute('data-delete-url')
        confirmDeleteBtn.setAttribute('href', url)
    })
})