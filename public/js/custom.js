document.addEventListener("DOMContentLoaded", function () {
  const deleteForms = document.querySelectorAll("form[onsubmit='return confirmDelete()']");

  deleteForms.forEach(form => {
    form.onsubmit = function () {
      return confirm('本当に削除しますか？');
    };
  });
});
