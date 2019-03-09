@extends('layouts.vue')

@section('styles')

<!-- Styles -->
        <style>

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .title {
                font-size: 2em;
            }

        </style>
@endsection

@section('content')
<!-- VUE Entries Column -->

<div class="col-md-12">

    <div class="flex-center position-ref full-height">
        <div class="content" id="app1">
            <div class="title m-b-md">
                <p>@{{ helloMessage }}</p>
            </div>
        </div>
    </div>

    <div class="flex-center position-ref full-height">
        <div class="content" id="app-2">
            <div class="title m-b-md">
                <span v-bind:title='message'>
                    Подержи курсор надо мной пару секунд,
                    чтобы увидеть динамически связанное значение title!
                </span>

                <p>Двойные фигурные скобки: @{{ rawHtml }}</p>
                <p>Директива v-html: <span v-html="rawHtml"></span></p>
            
            </div>
        </div>
    </div>
            
    <div class="flex-center position-ref full-height">
        <div class="content"  id="app-3">
        <div class="title m-b-md">
            <p v-if="seen">Сейчас меня видно</p>
        </div>
        </div>
    </div>
    
    <div class="flex-center position-ref full-height">
        <div class="content"  id="app-4">
        <div class="title m-b-md">
                <input type="text"><input type='button' value="Add New" id="button">
              
            <ol>
                <li v-for="todo in todos">
                @{{ todo.text }}
                </li>
            </ol>
            </div>
        </div>
    </div>
    
    <div class="flex-center position-ref full-height">
        <div class="content"  id="app-5">
        <div class="title m-b-md">
          <p>@{{ message }}</p>
          <button v-on:click="reverseMessage">Обратить порядок букв в сообщении</button>
          <button @click="reverseMessage">Обратить порядок букв в сообщении</button>
          
          </div>
        </div>
    </div>
    
    <div class="flex-center position-ref full-height">
        <div class="content"  id="app-6">
        <div class="title m-b-md">
          <p>@{{ message }}</p>
          <input v-model="message">
        </div>
        </div>
        <div class="content">
            <hr>
        </div>
    </div>

    <div class="flex-center position-ref full-height">
        <div class="content"  id="app-7">
        <div class="title m-b-md">
            <h2>Введённое многострочное сообщение:</h2>
            <p style="white-space: pre-line;">@{{ message }}</p>
        </div>
            <div class="content">
                    <textarea v-model="message" placeholder="введите несколько строчек"></textarea>
            </div>
        </div>
    </div>

    <div class="flex-center position-ref full-height">
            <div class="content"  id="app-8">
            <div class="title m-b-md">
                <input type="checkbox" id="checkbox" v-model="checked">
            </div>
                <div class="content">
                <label for="checkbox">@{{ checked }}</label>
                </div>
            </div>
    </div>

    <div class="flex-center position-ref full-height">
            <div class="content"  id="app-9">
            <div class="title m-b-md">
                <input type="checkbox" id="jack" value="Джек" v-model="checkedNames">
                <label for="jack">Джек</label>
                <input type="checkbox" id="john" value="Джон" v-model="checkedNames">
                <label for="john">Джон</label>
                <input type="checkbox" id="mike" value="Майк" v-model="checkedNames">
                <label for="mike">Майк</label>
            </div>
                <div class="content">
                    <span>Отмеченные имена: @{{ checkedNames }}</span>
                </div>
            </div>
    </div>
    <div class="flex-center position-ref full-height">
            <div class="content"  id="app-10">
            <div class="title m-b-md">
                <input type="radio" id="one" value="Один" v-model="picked">
                <label for="one">Один</label>
                <input type="radio" id="two" value="Два" v-model="picked">
                <label for="two">Два</label>
            </div>
                <div class="content">
                    <span>Выбрано: @{{ picked }}</span>
                </div>
            </div>
    </div>
    <div class="flex-center position-ref full-height">
            <div class="content"  id="app-11">
            <div class="title m-b-md">
                    <select v-model="selected">
                            <option disabled value="">Выберите один из вариантов</option>
                            <option>А</option>
                            <option>Б</option>
                            <option>В</option>
                          </select>
            </div>
                <div class="content">
                        <span>Выбрано: @{{ selected }}</span>
                </div>
            </div>
    </div>

      

</div>
@endsection

@section('scripts')
<!-- версия для разработки, включает отображение полезных предупреждений в консоли -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script>
    (function(){

        
        var app1 = new Vue({
            el: "#app1",
            data: {
                helloMessage: 'Hello Vue.js!',
            },
        });

        var app2 = new Vue({
            el: '#app-2',
            data: {
              message: 'Вот когда вы загрузили эту страницу: ' + new Date(),
              rawHtml: '<strong>простой текст</strong>'
            }
        });

        var app3 = new Vue({
            el: '#app-3',
            data: {
              seen: true
            }
          });
          document.getElementById("app-3").addEventListener('click', function(){
              app3.seen = false;
          });

          var app4 = new Vue({
            el: '#app-4',
            data: {
              todos: [
                { text: 'Посадить дерево' },
                { text: 'Построить дом' },
                { text: 'Вырастить сына' }
              ]
            }
          });

          document.getElementById("button").addEventListener('click', function(){
              var newItem = document.querySelector('input[type="text"').value;
              app4.todos.push({ text: newItem });
          });

          var app5 = new Vue({
            el: '#app-5',
            data: {
              message: 'Hello Vue.js!'
            },
            methods: {
              reverseMessage: function () {
                this.message = this.message.split('').reverse().join('')
              }
            }
          });

          var app6 = new Vue({
            el: '#app-6',
            data: {
              message: 'Hello Vue!'
            }
          });
          var app7 = new Vue({
            el: '#app-7',
            data: {
              message: 'Hello Vue!'
            }
          });

          var app8 = new Vue({
            el: '#app-8',
            data: {
                checked: true
            }
          });

          new Vue({
            el: '#app-9',
            data: {
              checkedNames: []
            }
          })
        
          new Vue({
            el: '#app-10',
            data: {
                picked: []
            }
          })
        
          new Vue({
            el: '#app-11',
            data: {
                selected: '' 
            }
          })
    })();

</script>
@stop
