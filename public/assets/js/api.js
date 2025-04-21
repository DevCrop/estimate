document.querySelector("#save").addEventListener("click", (e) => {
  e.preventDefault();

  const form = document.querySelector("form");
  const formData = new FormData(form);

  const groups = [];
  document
    .querySelectorAll(".no-estimate-group")
    .forEach((groupEl, groupIndex) => {
      const group_title = groupEl.querySelector(
        'input[name="group_title[]"]'
      ).value;
      const group_price = groupEl.querySelector(
        'input[name="group_price[]"]'
      ).value;

      const items = [];
      groupEl
        .querySelectorAll(".no-estimate-item")
        .forEach((itemEl, itemIndex) => {
          const description = itemEl.querySelector(
            'input[name="item_description[]"]'
          ).value;
          items.push({
            item_order: itemIndex + 1,
            description: description,
          });
        });

      groups.push({
        group_order: groupIndex + 1,
        title: group_title,
        price: group_price,
        items: items,
      });
    });

  formData.append("groups", JSON.stringify(groups));

  fetch("/nb_table/api/save.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        alert("저장 완료!");
        location.reload();
      } else {
        alert("저장 실패: " + data.message);
      }
    });
});
