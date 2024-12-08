<!-- Modal -->
<div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateModalLabel">Sélectionner une date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="dateForm" action="{{ route('get-attendances') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="inputDate">Date :</label>
                        <input type="date" class="form-control" id="inputDate" name="inputDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    (function() {
        document.addEventListener('DOMContentLoaded', function() {
            // Ouvrir la modal lors du clic sur le lien
            document.getElementById('employee-list-link').addEventListener('click', function() {
                document.getElementById('dateModal').style.display = 'block';
                document.getElementById('dateModal').classList.add('show');
                document.body.classList.add('modal-open');
            });
            // Fermer la modal lors du clic sur le bouton de fermeture
            document.querySelectorAll('[data-dismiss="modal"]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    document.getElementById('dateModal').style.display = 'none';
                    document.getElementById('dateModal').classList.remove('show');
                    document.body.classList.remove('modal-open');
                });
            });
        });
    })();
</script>
