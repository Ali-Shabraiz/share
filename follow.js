function followHim(folderLoc,id,address){
            $.ajax({
                url: `${folderLoc}PHP/${address}followHim.php`,
                method: 'POST',
                data: {fID: id},
                success: (data => {
                    fetch_all_profiles();
                    // console.log(data)
                })
            })
        }
       

        function followText(isFollowed,isFollowing){
            if(isFollowed && isFollowing)
                return "Unfriend";
            else if(isFollowed == 0 && isFollowing == 1)
                return "Unfollow";
            else if(isFollowing == 0 && isFollowed == 1)
                return "Follow Back";
            else 
                return "Follow";
        }
         function followAddress(isFollowed,isFollowing){
            if(isFollowed && isFollowing)
                return "un";
            else if(isFollowed == 0 && isFollowing == 1)
                return "un";
            else if(isFollowing == 0 && isFollowed == 1)
                return "";
            else 
                return "";
        }