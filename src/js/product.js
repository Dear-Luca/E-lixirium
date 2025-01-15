document.querySelector("select[name='duration']").addEventListener("change", function () {
    location.href = 'index.php?page=product&id=' + this.value;
});