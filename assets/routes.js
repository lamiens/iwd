      /**
       * Pagination
      */

            // dashboard

            // path to delete story
            $('.delete_story').click(()=>{
                console.log('testy');
                $.get('../views/deleteStory.php', (data, status)=>{
                  $('.content').html(data);
             } );
            })

            // create a story

             // path to delete story
             $('.create_story').click(()=>{
                $.get('../views/createStory.php', (data, status)=>{
                //$.get('?view=createStory', (data, status)=>{
                  $('.content').html(data);
             } );
            })

            // path to update story 
            $('.update_story').click(()=>{
                console.log('testy');
                $.get('../views/updateStory.php', (data, status)=>{
                  $('.content').html(data);
             } );
            })

            // path to list epics 
            $('.list_epics').click(()=>{
                console.log('testy');
                $.get('../views/getEpics.php', (data, status)=>{
                  $('.content').html(data);
             } );
            })


            // path to list milestone
            $('.list_milestones').click(()=>{
                console.log('testy');
                $.get('../views/getMilestone.php', (data, status)=>{
                  $('.content').html(data);
             } );
            })