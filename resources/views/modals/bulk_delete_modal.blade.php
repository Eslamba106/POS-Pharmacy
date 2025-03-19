<div id="bulk-delete-modal" class="modal fade">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{ __('general.delete_confirmation') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mt-1">{{ __('general.are_you_sure_to_delete_this') }}</p>
                <button type="button" class="btn btn-link mt-2" data-dismiss="modal">{{ __('general.cancel') }}</button>
                <a href="javascript:void(0)" onclick="bulk_delete()" class="btn btn-primary mt-2">{{ __('general.delete') }}</a>
            </div>
        </div>
    </div>
</div>