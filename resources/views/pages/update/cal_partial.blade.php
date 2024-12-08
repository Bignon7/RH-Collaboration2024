<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/locales/fr.js"></script>


<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between mb-3">
        <div>
            <input type="date" id="jumpToDate" class="form-control">
        </div>
        <div>
            <button id="goToDateBtn" class="btn btn-primary">Aller à</button>
        </div>
        <div>
            <button id="showEventListBtn" class="btn btn-secondary">Liste des évènements</button>
        </div>
    </div>
    <div id='calendar'></div>
</div>

<!-- Modal for adding event -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('store.events') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Ajouter un évènement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Intitulé de l'évènement</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="end" class="form-label">Date de fin</label>
                        <input type="date" class="form-control" id="end" name="end" required>
                    </div>
                    <input type="hidden" id="start" name="start">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for viewing event details -->
<div class="modal fade" id="viewEventModal" tabindex="-1" aria-labelledby="viewEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEventModalLabel">Détails de l'évènement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="eventTitle"></h5>
                <p id="eventDescription"></p>
                <p><strong>Début:</strong> <span id="eventStart"></span></p>
                <p><strong>Fin:</strong> <span id="eventEnd"></span></p>

                <form id="deleteEventForm" action="" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="eventId" name="id">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for listing events -->
<div class="modal fade" id="eventListModal" tabindex="-1" aria-labelledby="eventListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventListModalLabel">Liste des évènements</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="eventList" class="list-group">
                    <!-- Event list will be populated here -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var userRole = "{{ $userRole }}";
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            initialView: 'dayGridMonth',
            editable: userRole == 'Admin',
            selectable: userRole == 'Admin',
            buttonText: {
                today: 'Aujourd\'hui'
            },
            select: function(info) {
                if (userRole == 'Admin') {
                    var modal = new bootstrap.Modal(document.getElementById('eventModal'));
                    document.getElementById('start').value = info.startStr;
                    document.getElementById('end').value = info.endStr;
                    modal.show();
                    calendar.unselect();
                }
            },
            events: {!! $eventsJson !!},

            eventClick: function(info) {
                var modal = new bootstrap.Modal(document.getElementById('viewEventModal'));
                document.getElementById('eventTitle').innerText = info.event.title;
                document.getElementById('eventDescription').innerText = info.event.extendedProps
                    .description;
                document.getElementById('eventStart').innerText = info.event.start
                    .toLocaleDateString();
                document.getElementById('eventEnd').innerText = info.event.end ? info.event.end
                    .toLocaleDateString() : '';
                document.getElementById('eventId').value = info.event
                    .id; // Set the event ID in the hidden input

                var deleteForm = document.getElementById('deleteEventForm');
                deleteForm.action = '{{ route('events.destroy', ['id' => 0]) }}'.replace('0', info
                    .event.id);

                modal.show();
            },

            eventTimeFormat: { // like '14:30:00'
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                meridiem: false // remove 'a'/'p'
            }
        });
        calendar.render();

        // Event listener for the "Go to Date" button
        document.getElementById('goToDateBtn').addEventListener('click', function() {
            var dateStr = document.getElementById('jumpToDate').value;
            if (dateStr) {
                var date = new Date(dateStr);
                calendar.gotoDate(date);
            }
        });

        // Event listener for the "Show Event List" button
        document.getElementById('showEventListBtn').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('eventListModal'));
            var eventListEl = document.getElementById('eventList');
            eventListEl.innerHTML = ''; // Clear the existing list

            // Populate the event list
            calendar.getEvents().forEach(function(event) {
                var listItem = document.createElement('li');
                listItem.classList.add('list-group-item');
                listItem.innerHTML =
                    `<strong>${event.title}</strong><br>Début: ${event.start.toLocaleDateString()}<br>Fin: ${event.end ? event.end.toLocaleDateString() : ''}`;
                eventListEl.appendChild(listItem);
            });

            modal.show();
        });
    });
</script>

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
