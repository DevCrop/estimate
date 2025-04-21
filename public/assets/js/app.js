console.log("app.js loaded");

// 트리거 및 이벤트 바인딩
class EstimateTrigger {
  constructor() {
    this.selectors = {
      addGroup: '[data-trigger="add-group"]',
      addItem: '[data-trigger="add-item"]',
      removeGroup: '[data-trigger="remove-group"]',
      removeItem: '[data-trigger="remove-item"]',
    };
  }

  bindAddGroup(callback) {
    const btn = document.querySelector(this.selectors.addGroup);
    if (btn) btn.addEventListener("click", callback);
  }

  bindAddItem(groupEl, callback) {
    const btn = groupEl.querySelector(this.selectors.addItem);
    if (btn) btn.addEventListener("click", callback);
  }

  bindRemoveGroup(groupEl, callback) {
    const btn = groupEl.querySelector(this.selectors.removeGroup);
    if (btn) btn.addEventListener("click", callback);
  }

  bindRemoveItem(itemEl, callback) {
    const btn = itemEl.querySelector(this.selectors.removeItem);
    if (btn) btn.addEventListener("click", callback);
  }
}

class EstimateItem {
  constructor() {}

  createItem(content = "") {
    const li = document.createElement("li");
    li.className = "no-estimate-item";
    li.innerHTML = `
      <input type="text" class="form-control d-inline-block w-auto" name="item_description[]" placeholder="항목 내용을 입력하세요" value="${content}">
      <button type="button" data-trigger="remove-item" class="btn btn-sm btn-outline-danger ms-2">삭제</button>
    `;
    return li;
  }
}

class EstimateGroup {
  constructor(container, trigger) {
    this.container = container;
    this.trigger = trigger;
    this.groupCount = 0;
    this.item = new EstimateItem();
  }

  addGroup() {
    this.groupCount++;
    const groupEl = document.createElement("div");
    groupEl.className = "no-estimate-group";
    groupEl.innerHTML = this.getGroupTemplate(this.groupCount);
    this.container.appendChild(groupEl);

    const list = groupEl.querySelector(".no-estimate-wrap");
    const firstItem = this.item.createItem();
    list.appendChild(firstItem);

    // 항목 추가 버튼 이벤트 연결
    this.trigger.bindAddItem(groupEl, () => {
      const itemEl = this.item.createItem();
      list.appendChild(itemEl);

      // 항목 삭제 버튼 이벤트
      this.trigger.bindRemoveItem(itemEl, () => {
        itemEl.remove();
      });
    });

    // 그룹 삭제 버튼 이벤트 연결
    this.trigger.bindRemoveGroup(groupEl, () => {
      groupEl.remove();
    });

    // 최초 항목의 삭제 이벤트도 연결
    this.trigger.bindRemoveItem(firstItem, () => {
      firstItem.remove();
    });
  }
  getGroupTemplate(groupNum) {
    return `
    <div class="no-estimate-group__header d-flex align-items-center gap-3 mb-2">
      <button type="button" data-trigger="remove-group" class="btn btn-sm btn-outline-danger">
        <i class="fa-solid fa-grid-round"></i>
      </button>
      <span>${String(groupNum).padStart(2, "0")}</span>

      <input 
        type="text" 
        name="group_title[]" 
        class="form-control w-auto" 
        placeholder="그룹명 입력 (예: 홈페이지 제작)"
      >

      <input 
        type="number" 
        name="group_price[]" 
        class="form-control w-auto" 
        placeholder="금액 입력"
      >
    </div>

    <ul class="no-estimate-wrap"></ul>

    <div class="text-end mt-2">
      <button type="button" class="btn btn-sm btn-outline-secondary" data-trigger="add-item">+ 항목 추가</button>
    </div>
  `;
  }
}

// ▶️ 전체 앱 초기화 클래스
class App {
  constructor() {
    this.trigger = new EstimateTrigger();
    this.group = null;
  }

  init() {
    const container = document.querySelector(".no-estimate-container");
    if (!container) return;

    this.group = new EstimateGroup(container, this.trigger);
    this.trigger.bindAddGroup(() => this.group.addGroup());
  }
}

// ▶️ 실행
const app = new App();
app.init();
