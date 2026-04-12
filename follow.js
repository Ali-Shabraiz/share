function followHim(folderLoc, id, address,functionName) {
    $.ajax({
        url: `${folderLoc}PHP/${address}followHim.php`,
        method: 'POST',
        data: { fID: id },
        success: (data => {
            eval(`${functionName}(data,id)`)
        })
    })
}

function profilesAfterFollow(data,id) {
    document.getElementById(`followersNumber${id}`).textContent = data.follower;
    document.getElementById(`followingNumber${id}`).textContent = data.following;
    document.getElementById(`friendNumber${id}`).textContent = data.friends;
    document.getElementById(`likeNumber${id}`).textContent = data.likes;
    document.getElementById(`scoresNumber${id}`).textContent = data.scores;
    document.getElementById(`followBtn${id}`).textContent = data.followText;
    document.getElementById(`followForm_${id}`).dataset.address = followAddress(data.isFollower, data.isFollowing);
}
function postAfterFollow(data,id){
   var followBtns =  document.querySelectorAll(`.postFollowBtn${id}`);
   followBtns.forEach(btn => {
    btn.dataset.address = followAddress(data.isFollower, data.isFollowing);
    btn.textContent = followText(data.isFollower, data.isFollowing);
   })
   

}
function followText(isFollowed, isFollowing) {
    if (isFollowed && isFollowing)
        return "Unfriend";
    else if (isFollowed == 0 && isFollowing == 1)
        return "Unfollow";
    else if (isFollowing == 0 && isFollowed == 1)
        return "Follow Back";
    else
        return "Follow";
}
function followAddress(isFollowed, isFollowing) {
    if (isFollowed && isFollowing)
        return "un";
    else if (isFollowed == 0 && isFollowing == 1)
        return "un";
    else if (isFollowing == 0 && isFollowed == 1)
        return "";
    else
        return "";
}