<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Calendar Planner</title>
  <link rel="stylesheet" href="calendar.css" />
</head>
<body>
  <div class="app-container">
    <div class="main-content">
      <div class="calendar-view" id="calendarView">
        <div class="calendar-header">
          <button id="prevMonthBtn" class="nav-btn">&lt; Prev</button>
          <h2 id="currentMonthYear">May 2025</h2>
          <button id="nextMonthBtn" class="nav-btn">Next &gt;</button>
        </div>

        <div class="weekdays">
          <div>MONDAY</div>
          <div>TUESDAY</div>
          <div>WEDNESDAY</div>
          <div>THURSDAY</div>
          <div>FRIDAY</div>
          <div>SATURDAY</div>
          <div>SUNDAY</div>
        </div>

        <div class="calendar-grid" id="calendarGrid">
          <!-- Days dynamically generated here -->
        </div>
      </div>

      <div id="fullView" style="display: none; padding: 20px;">
        <button id="backToCalendarBtn" class="add-item-btn">← Back to Calendar</button>
        <h2>All Events</h2>
        <ul id="allEventsList"></ul>
        <h2>All ToDos</h2>
        <ul id="allTodosList"></ul>
      </div>

      <div class="sidebar">
        <div class="sidebar-section todo-container" id="todoSection">
          <h3>TO DO LIST</h3>
          <ul class="todo-list" id="todoList"></ul>
          <button class="add-item-btn" id="editTodoBtn">Edit TO DO List</button>
        </div>

        <div class="sidebar-section events-container" id="eventsSection">
          <h3>EVENTS</h3>
          <ul class="events-list" id="eventsList"></ul>
          <button id="viewAllBtn" class="add-item-btn">View All Events & ToDos</button>
        </div>
      </div>
    </div>

    <!-- Add Event Modal -->
    <div id="addEventModal" class="modal">
      <div class="modal-content add-event-modal-content">
        <span class="close-btn" id="closeAddEventModal">&times;</span>
        <h2>Add/Edit Event - <span id="eventDayLabel"></span></h2>

        <label for="eventTitle">Title:</label>
        <input type="text" id="eventTitle" placeholder="Enter event title" />

        <label for="eventTime">Time:</label>
        <input type="time" id="eventTime" />

        <label for="eventPicture">Upload Picture:</label>
        <input type="file" id="eventPicture" />

        <label for="eventNotes">Notes:</label>
        <textarea id="eventNotes" placeholder="Enter event notes..."></textarea>

        <button class="save-event-btn" id="saveEventBtn">Save Event</button>
      </div>
    </div>

    <!-- TO DO LIST Modal -->
    <div class="modal" id="todoModal">
      <div class="modal-content">
        <span class="close-btn" id="closeTodoModal">&times;</span>
        <h2>Edit TO DO LIST</h2>
        <div class="modal-list-container">
          <h3>Your Editable Tasks</h3>
          <ul class="editable-list" id="editableTodoList"></ul>
        </div>
        <div class="button-container">
          <button class="add-item-btn" id="addTodoItemBtn">Add Task</button>
          <button class="save-btn" id="saveTodoBtn">Save List</button>
        </div>
      </div>
    </div>
  </div>

  <script src="calendar.js"></script>
</body>
</html>
