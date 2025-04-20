console.log("app.js");

class EstimateGroupControl {
  constructor() {
    this.groupWrap = document.querySelector(".no-estimate-wrap");
    this.init();
  }

  init() {
    const addGroupButton = new EstimateTriggerControl(
      "그룹 추가",
      "button",
      this.addGroup.bind(this)
    );

    const buttonEl = addGroupButton.getTrigger();
    this.groupWrap.parentNode.insertBefore(buttonEl, this.groupWrap);
  }

  addGroup() {
    const groupHTML = this.getGroupWrap();
    this.groupWrap.insertAdjacentHTML("beforeend", groupHTML);
  }

  getGroupWrap() {
    return `
      <div class="no-estimate-group">
        <h3>그룹 헤더</h3>
        <div class="no-estimate-group__header form-group">
          <button type="button" class="no-estimate-group-control">
            <i class="fa-solid fa-grid-round"></i>
          </button>
          <span>01</span>
          <input type="text" name="group_title[]" placeholder="제목을 입력하세요" class="form-control" />
          <input type="text" name="group_price" placeholder="금액을 입력해주세요." class="form-control" />
          <div class="no-estimate-tooltip">
            <button type="button" class="group-remove-btn">수정</button>
            <button type="button" class="group-remove-btn">삭제</button>
          </div>
        </div>
        <hr>
      </div>
    `;
  }

  getGroupItem() {
    return `
      <div class="no-estimate-items">
        <!-- 여기에 아이템이 들어감 -->
      </div>
    `;
  }

  remove(target) {
    target.closest(".no-estimate-group").remove();
  }
}

class EstimateTriggerControl {
  constructor(label, type, action) {
    this.label = label;
    this.type = type;
    this.action = action;
  }

  getTrigger() {
    const triggerWrapper = document.createElement("div");
    triggerWrapper.classList.add("no-estimate-trigger-wrap");

    const triggerButton = document.createElement("button");
    triggerButton.type = "button";
    triggerButton.textContent = this.label;

    if (typeof this.action === "function") {
      triggerButton.addEventListener("click", this.action);
    }

    triggerWrapper.appendChild(triggerButton);
    return triggerWrapper;
  }
  remoteTrigger() {}
}

const test = new EstimateGroupControl();

// 아이템을 생성, 삭제, 수정
class EstimateItemControl {}

// 앱 관리
class EstimateApp {}
