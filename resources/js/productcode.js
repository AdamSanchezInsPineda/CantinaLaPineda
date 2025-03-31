document.getElementById("name").addEventListener("input", function() {
    const code_2 = document.getElementById("code_2");
    const productFirstTwoLetters = document.getElementById("name").value.slice(0, 2);
    code_2.innerHTML = `-${productFirstTwoLetters.toUpperCase()}`;
});

document.getElementById("category_id").addEventListener("input", function() {
    const code_1 = document.getElementById("code_1");
    const selectedCategoryId = document.getElementById("category_id").value;
    const selectedOption = document.querySelector(`#category_id option[value="${selectedCategoryId}"]`);
    const selectedCategoryName = selectedOption ? selectedOption.getAttribute("data-name") : "";

    code_1.innerHTML = selectedCategoryName.slice(0, 2).toUpperCase();
});