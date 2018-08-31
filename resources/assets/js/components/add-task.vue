<template>
<div>
    <button class="element-center mt-4 mb-4 p-2 bg-orange text-white" @click.prevent="open">Add new task</button>
        <form v-if="createable" action="#" method="post">  
          <input class="w-1/4 element-center mt-2 mb-2 p-2 border-solid border border-grey text-grey-darkest" v-model="name" type="text" placeholder="Name">
          <div class="text-center text-red font-semibold" v-if="invalidNameText.length > 0 && name.length > 0">
              {{ invalidNameText }}
          </div>
          <input class="w-1/4 element-center mt-2 mb-2 p-2 border-solid border border-grey text-grey-darkest" v-model="responsible" type="text" placeholder="Responsible">
           <div class="text-center text-red font-semibold" v-if="invalidResponsibleText.length > 0 && responsible.length > 0">
              {{ invalidResponsibleText }}
          </div>
          <input class="w-1/4 element-center mt-2 mb-2 p-2 border-solid border border-grey text-grey-darkest" v-model="dueDate" type="date" placeholder="Due Date">
            <div class="text-center text-red font-semibold" v-if="invalidDueDateText.length > 0 && dueDate.length > 0">
              {{ invalidDueDateText }}
          </div>
            <button :disabled="disablesave" class="w-1/6 element-center mt-2 mb-2 pt-2 pb-2 bg-orange text-white" @click.prevent="save">
              save
            </button>
            <button class="w-1/6 element-center mt-2 mb-2 pt-2 pb-2 bg-red text-white" @click.prevent="cancel">
              cancel
            </button>
        </form>
</div>
</template>

<script>
export default {
  name: "add-task",
  props: ["tasks", "user"],
  data() {
    return {
      errors: [],
      createable: false,
      name: "",
      dueDate: ""
    };
  },
  computed: {
    disablesave() {
      if ( !this.name | !this.responsible | !this.dueDate | 
        this.invalidNameText.length > 0 |
        this.invalidResponsibleText.length > 0 |
        this.invalidDueDateText.length > 0
      )
        return true;

      return false;
    },
    responsible(){
      if(this.user.length == 0) return "";

      if(typeof this.user == 'object'){
        return this.user.name;
      }else{
        return this.user['name'];
      }
         
    },
    invalidNameText() {
      if (this.name.length < 3) return "Name must be at least 3 charactors";
      if (this.name.length > 128)
        return "Name must be less than 128 charactors";
      if (this.tasks != null) {
        var currentName = this.name;
        let exists = this.tasks.some(function(task) {
          if (task.status == "completed" || task.status == "deleted")
            return false;
          return task.name.toUpperCase() == currentName.toUpperCase();
        });
        if (exists) return "A task with that name already exists";
      }

      return "";
    },
    invalidResponsibleText() {
      if (this.responsible.length < 3)
        return "Responsible must be at least 3 characters";
      if (this.responsible.length > 50)
        return "Name must be less than 50 characters";

      return "";
    },
    invalidDueDateText() {
      if (this.tasks != null) {
        var currentDueDate = Date.parse(this.dueDate);
        //var d = new Date();
        //var currentDate = d.toLocaleDateString();
        let currentDate = new Date(); // needs to be formatted
        console.log(currentDueDate);
        console.log(currentDate);
        if (currentDueDate < currentDate)
          return "A due date cannot be in the past";
      }

      return "";
    }
  },
  methods: {
    open() {
      this.createable = true;
    },
    save() {
      if (this.name && this.responsible && this.dueDate) {
        let data = {
          name: this.name,
          dueDate: this.dueDate,
          status: "ongoing"
        };
        if(this.saveTaskToDatabase(data)) {
          this.createable = false;
        }
      }
      this.errors = [];

      if (!this.name) {
        this.errors.push("Name required.");
      }
      if (!this.responsible) {
        this.errors.push("Responsible required.");
      }
      if (!this.dueDate) {
        this.errors.push("Due date required.");
      }
    },
    saveTaskToDatabase(data) {
      var self = this;
      axios
        .post("/create-task", data)
        .then(function(response) {
          self.$emit("save", data);
        })
        .catch(function(error) {
          alert("something went wrong");
        });
    },
    cancel() {
      this.createable = false;
    }
  }
};
</script>

<style>
button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
