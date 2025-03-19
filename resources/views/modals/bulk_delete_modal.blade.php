<div id="bulk-delete-modal" class="modal fade">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{ __('Delete Confirmation') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mt-1">{{ __('Are you sure to delete those files?') }}</p>
                <button type="button" class="btn btn-link mt-2" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a href="javascript:void(0)" onclick="bulk_delete()" class="btn btn-primary mt-2">{{ __('Delete') }}</a>
            </div>
        </div>
    </div>
</div>