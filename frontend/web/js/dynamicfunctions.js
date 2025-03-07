$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Maksimal jumlah item telah tercapai!");
});

if ($("#requestTable").length > 0) {
    $(document).ready(function() {
        $('#requestTable').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });
    });
}

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-items").each(function(index) {
        jQuery(this).html("item: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-items").each(function(index) {
        jQuery(this).html("item: " + (index + 1))
    });
});

