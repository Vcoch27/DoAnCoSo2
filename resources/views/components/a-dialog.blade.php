<!-- resources/views/components/dialog.blade.php -->

<div class="modal fade dialog" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">

    <div class="modal-dialog box-dialog">
        <div class="modal-content bg-img bg-img-bottom" style="background-image: url(https://wallpaperaccess.com/full/2454628.png)">
            <div class="modal-header">
                <h6 class="modal-title" id="{{ $id }}Label">{{ $title }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<style>
    .dialog {
        margin-top: 200px;
        z-index: 99;
    }

    .box-dialog {
        color: white;
        font-size: 18px;
        width: 70%;
    }

    .btn-dialog {
        width: 100px;
        height: 40px;
    }

    .modal-body {
        text-align: center;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>