<template>
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background:#60bbd1;color:white;font-weight:">Example Component</div>

                    <div class="panel-body">
                        <p>I'm an example component</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        component:
            console.log('Component mounted.')
        }
    }
</script>
