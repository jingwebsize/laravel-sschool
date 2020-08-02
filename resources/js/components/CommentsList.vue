<template>
    <div class="col-md-4">
        <form>
            <div class="form-group">
                <textarea 
                    class="form-control" 
                    rows="8" cols="8" 
                    maxlength="130" 
                    required>
                </textarea>
            </div>
            <div class="form-group">
                {{ postid }}
            </div>
        </form>        
    </div>
</template>
<script>
export default{
    mounted(){
        axios.get('/postercomments/{{$postid}}')
        .then(response=>
            console.log(response.data);
        )
    },
    props: ['postid'],
    // data() {
    //     return {
    //         postid: 0,
    //     }
    // },
}
</script>