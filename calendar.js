// --- DATA STORAGE ---
let todos = [];
let events = [];
// Event structure: { id, year, month, day, title, time, notes, picture }

// --- DOM REFERENCES ---
const calendarGrid = document.getElementById("calendarGrid");
const todoListEl = document.getElementById("todoList");
const eventsListEl = document.getElementById("eventsList");
const editableTodoListEl = document.getElementById("editableTodoList");
const allEventsListEl = document.getElementById("allEventsList");
const allTodosListEl = document.getElementById("allTodosList");

const todoModal = document.getElementById("todoModal");
const addEventModal = document.getElementById("addEventModal");
const eventDayLabel = document.getElementById("eventDayLabel");
const eventTitleInput = document.getElementById("eventTitle");
const eventTimeInput = document.getElementById("eventTime");
const eventNotesInput = document.getElementById("eventNotes");
const eventPictureInput = document.getElementById("eventPicture");
const saveEventBtn = document.getElementById("saveEventBtn");

const fullView = document.getElementById("fullView");
const calendarView = document.getElementById("calendarView");

const backToCalendarBtn = document.getElementById("backToCalendarBtn");
const editTodoBtn = document.getElementById("editTodoBtn");
const closeTodoModalBtn = document.getElementById("closeTodoModal");
const closeAddEventModalBtn = document.getElementById("closeAddEventModal");
const addTodoItemBtn = document.getElementById("addTodoItemBtn");
const saveTodoBtn = document.getElementById("saveTodoBtn");
const viewAllBtn = document.getElementById("viewAllBtn");

const prevMonthBtn = document.getElementById("prevMonthBtn");
const nextMonthBtn = document.getElementById("nextMonthBtn");
const currentMonthYear = document.getElementById("currentMonthYear");

// --- STATE ---
let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();
let currentSelectedDay = null;

// --- HELPER FUNCTIONS ---
function monthName(monthIndex) {
  return new Date(0, monthIndex).toLocaleString('default', { month: 'long' });
}

function updateURL(year, month) {
  const url = new URL(window.location);
  url.searchParams.set("year", year);
  url.searchParams.set("month", month + 1); // +1 because JS months are 0-indexed
  history.replaceState({}, "", url);
}

function generateCalendar(year, month) {
  calendarGrid.innerHTML = "";
  currentMonthYear.textContent = `${monthName(month)} ${year}`;
  updateURL(year, month);

  const firstDayDate = new Date(year, month, 1);
  const daysInMonth = new Date(year, month + 1, 0).getDate();
  const firstDayWeekday = (firstDayDate.getDay() + 6) % 7;

  for (let i = 0; i < firstDayWeekday; i++) {
    const emptyCell = document.createElement("div");
    emptyCell.className = "empty";
    calendarGrid.appendChild(emptyCell);
  }

  for (let day = 1; day <= daysInMonth; day++) {
    const cell = document.createElement("div");
    cell.className = "date-cell";
    cell.textContent = day;

    if (events.some(e => e.year === year && e.month === month && e.day === day)) {
      cell.classList.add("event");
    }

    cell.addEventListener("click", () => openAddEventModal(day));
    calendarGrid.appendChild(cell);
  }
}

function openAddEventModal(day) {
  currentSelectedDay = day;
  eventDayLabel.textContent = `${day} ${monthName(currentMonth)} ${currentYear}`;
  eventTitleInput.value = "";
  eventTimeInput.value = "";
  eventNotesInput.value = "";
  eventPictureInput.value = "";
  addEventModal.style.display = "flex";
}

function closeModal(modal) {
  modal.style.display = "none";
}

function renderTodoList() {
  todoListEl.innerHTML = "";
  todos.forEach(todo => {
    const li = document.createElement("li");
    li.textContent = todo;
    todoListEl.appendChild(li);
  });
}

function renderEditableTodos() {
  editableTodoListEl.innerHTML = "";
  todos.forEach((todo, index) => {
    const li = document.createElement("li");
    const input = document.createElement("input");
    input.type = "text";
    input.value = todo;

    const removeBtn = document.createElement("button");
    removeBtn.textContent = "X";
    removeBtn.addEventListener("click", () => {
      todos.splice(index, 1);
      renderEditableTodos();
    });

    li.appendChild(input);
    li.appendChild(removeBtn);
    editableTodoListEl.appendChild(li);
  });
}

function renderEventsList() {
  eventsListEl.innerHTML = "";
  events.forEach(event => {
    const li = document.createElement("li");
    li.textContent = `${event.day} ${monthName(event.month)}: ${event.title}`;
    eventsListEl.appendChild(li);
  });
}

function renderAllItems() {
  allEventsListEl.innerHTML = "";
  events.forEach(event => {
    const li = document.createElement("li");
    li.innerHTML = `<strong>${event.day} ${monthName(event.month)}:</strong> ${event.title} @ ${event.time} <br>Notes: ${event.notes}`;
    allEventsListEl.appendChild(li);
  });

  allTodosListEl.innerHTML = "";
  todos.forEach(todo => {
    const li = document.createElement("li");
    li.textContent = todo;
    allTodosListEl.appendChild(li);
  });
}

// --- EVENT HANDLERS ---
saveEventBtn.addEventListener("click", () => {
  const title = eventTitleInput.value.trim();
  const time = eventTimeInput.value;
  const notes = eventNotesInput.value.trim();
  const picture = eventPictureInput.files[0]?.name || "";

  if (!title || !currentSelectedDay) return;

  events.push({
    id: Date.now(),
    year: currentYear,
    month: currentMonth,
    day: currentSelectedDay,
    title,
    time,
    notes,
    picture
  });

  closeModal(addEventModal);
  generateCalendar(currentYear, currentMonth);
  renderEventsList();
});

editTodoBtn.addEventListener("click", () => {
  renderEditableTodos();
  todoModal.style.display = "flex";
});

addTodoItemBtn.addEventListener("click", () => {
  todos.push("");
  renderEditableTodos();
});

saveTodoBtn.addEventListener("click", () => {
  const inputs = editableTodoListEl.querySelectorAll("input");
  todos = Array.from(inputs).map(input => input.value.trim()).filter(Boolean);
  closeModal(todoModal);
  renderTodoList();
});

closeTodoModalBtn.addEventListener("click", () => closeModal(todoModal));
closeAddEventModalBtn.addEventListener("click", () => closeModal(addEventModal));

viewAllBtn.addEventListener("click", () => {
  fullView.style.display = "block";
  calendarView.style.display = "none";
  renderAllItems();
});

backToCalendarBtn.addEventListener("click", () => {
  fullView.style.display = "none";
  calendarView.style.display = "block";
});

prevMonthBtn.addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  generateCalendar(currentYear, currentMonth);
});

nextMonthBtn.addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  generateCalendar(currentYear, currentMonth);
});

// --- INITIALIZE ---
generateCalendar(currentYear, currentMonth);
renderTodoList();
renderEventsList();
