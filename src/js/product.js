document.querySelector("select#id_product").addEventListener("change", function () {
    location.href = 'index.php?page=product&id=' + this.value;
});