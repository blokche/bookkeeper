$(function()
{
    $deleteButtons = $('.btn-danger');
    $deleteForm = $deleteButtons.parent('form');

    $deleteButtons.on('click', function(event)
    {
        var sure = confirm('Êtes-vous certain de vouloir supprimer l\'élément ?');
        if (sure) {
            $deleteForm.submit();
        } else {
            return false;
        }
    })
});