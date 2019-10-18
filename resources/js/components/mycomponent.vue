<template>
    <div>
       <form>

            <div class="form-group">
                <label>ОГРН</label>
                <input class="form-control" type="text" placeholder="# ОГРН" disabled v-model="data">
            </div>

           <div class="form-group">
               <label for="exampleInputPassword1">Дата</label>
               <input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control"v-on:change="selectData" v-model="dataselect">
           </div>

           <div class="form-group" v-if="!imageSrc">
               <label>Курс</label>
               <input class="form-control" type="text" placeholder="курс" disabled v-model="kurs">
           </div>
           <div class="spinner-border" role="status" v-if="imageSrc">
               <span class="sr-only">Loading...</span>
           </div>


        </form>
    </div>
</template>

<script>
    export default {
        name: "mycomponent",
        props: ['data'],
        data () {
            return {
                info: null,
                dataselect:null,
                kurs:null,
                imageSrc:false,
            }
        },
        methods: {
            selectData: function (event) {
                this.imageSrc=true;
                axios
                    .get('/api/page?data='+this.dataselect)
                    .then(
                        response => {this.kurs = response.data; this.imageSrc=false;}
                    );
            }
        }

    }
</script>

<style scoped>

</style>