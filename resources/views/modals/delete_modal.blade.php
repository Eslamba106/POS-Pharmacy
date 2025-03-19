<!-- delete Modal -->
<div id="delete-modal" class="modal fade">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{__('general.delete_confirmation')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mt-1 fs-14">{{__('general.are_you_sure_to_delete_this')}}</p>
                <button type="button" class="btn btn-secondary rounded-0 mt-2" data-dismiss="modal">{{__('general.cancel')}}</button>
                <a href="" id="delete-link" class="btn btn-primary rounded-0 mt-2">{{__('general.delete')}}</a>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
