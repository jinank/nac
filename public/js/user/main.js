

function openModal(id) {
    if(id)
    {
        $(`#${id}`).modal('show');
    }
}

function managelike(videoId,index)
{
    $.ajax({
        url: BASE_URL + "/manageLikes?videoId=" + videoId,
        success: function (data) {
           
            if(data["status"]=="unlike")
            {
                
                $(`.like-icon-${index}`).removeClass().addClass(`like-icon-${index} fa fa-thumbs-o-up`);
                // $('.like-icon').removeClass(' fa-thumbs-up ')
                // $('.like-icon').addClass('  ')
            }
            else if(data["status"]=="liked")
            {
                $(`.like-icon-${index}`).removeClass().addClass(`like-icon-${index} fa fa-thumbs-up`);
            }
            $(`.like-count-${index}`).html(data["count"]);
            
        },
      });
}
function handleVoting(videoId,index)
{
    $.ajax({
        url: BASE_URL + "/manageVotes?videoId=" + videoId,
        success: function (data) {
            if(data.status=='selected')
            {
                const newTab = window.open(`${BASE_URL}/ballot`, "_blank");
            }
            else if(data.status=='no_exhausted')
            {
              $('#vote-limit-modal').modal('show')
            }
            else if(data.status=='already')
            {
              $('#already-voted-modal').modal('show')
            }
              
        },
    });


}
// edit profile toggle function
function openEditProfile()
{
    $('.toogle-profile').toggle()
}
function removeVote(id)
{
  $('#remove-vote-modal').modal('show');
  $('.videoId').val(id)
}
function revote(id)
{
  $('#re-vote-modal').modal('show');
  $('.videoId').val(id)
}


            