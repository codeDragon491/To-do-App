<template>
    <tr v-if="active" :class="completedClass">
          <input class="p-2 border-solid border border-grey text-grey-darkest" type="hidden" v-model="task.id">
          <td class="p-3 border-solid border border-grey">
            <a class="text-orange-light no-underline" v-if="!editable" href="#" @click.prevent="open">{{task.name}}</a>
            <input class="p-2 border-solid border border-grey text-grey-darkest" v-else type="text" v-model="task.name">
          </td>
          <td class="p-3 border-solid border border-grey text-grey-darkest"><p>{{user.name}}</p>
          </td>
          <td class="p-3 border-solid border border-grey text-grey-darkest"><p v-if="!editable">{{task.dueDate}}</p>
          <input class="p-2 border-solid border border-grey text-grey-darkest" v-if="editable" type="date" v-model="task.dueDate">
          </td>
          <td class="p-3 border-solid border border-grey text-grey-darkest"><p v-if="!editable">{{task.status}}</p>
            <input class="p-2 border-solid border border-grey text-grey-darkest" v-if="editable" type="text" v-model="task.status">
          </td> 
          <td class="p-3 border-solid border border-grey text-grey-darkest">
            <a class="text-orange-light" href="#" @click="complete"><i class="fas fa-check"></i></a>
            <button class="p-2 bg-orange text-white" v-if="editable" @click="save">
              save
            </button>
            <button class="p-2 bg-green text-white" v-if="editable" @click="cancel">
              cancel
            </button>
            <button class="p-2 bg-red text-white" v-if="editable" @click="discard">
              delete
            </button>
          </td>
    </tr>
</template>

<script>
export default {
  name: "task-row",
  props: ["task", "user"],
  mounted() {},
  data() {
    return {
      editable: false
    };
  },
  computed: {
    completedClass() {
      return this.isCompleted ? "line-through" : "";
    },
    active() {
      return this.task.status != "deleted";
    },
    isCompleted() {
      return this.task.status == "completed";
    },
     responsible(){
      if(this.user.length == 0) return "";

      if(typeof this.user == 'object'){
        return this.user.name;
      }else{
        return this.user['name'];
      }
         
    }
  },
  methods: {
    open() {
      this.editable = true;
    },
    save() {
      this.editable = false;

      let data = {
        id: this.task.id,
        name: this.task.name,
        dueDate: this.task.dueDate,
        status: this.task.status
      };
      this.updateTaskInDatabase(data);
    },
    updateTaskInDatabase(data) {
      console.log(data);
      var self = this;
      axios
        .post("/update-task", data)
        .then(function(response) {
          console.log(response.data);
        })
        .catch(function(error) {
          alert("something went wrong");
        });
    },
    cancel(){
      this.editable = false;
    },
    discard() {
      this.task.status = "deleted";
      let data = {
        id: this.task.id
      };
      this.deleteTaskInDatabase(data);
    },
    deleteTaskInDatabase(data) {
      console.log(data.id);
      var self = this;
      axios
        .get("/delete-task/" + data.id)
        .then(function(response) {
          console.log(response.data);
        })
        .catch(function(error) {
          alert("something went wrong");
        });
    },
    complete() {
      this.task.status = "completed";
    }
  }
};
</script>
