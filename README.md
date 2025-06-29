# Teste Técnico Alloy - To-Do List

## Descrição do Projeto

Este projeto foi criado utilizando docker, porém, toda a estrutura permanece a mesma conforme foi solicitado no requisito do projeto. Versão do docker necessária

- Docker => 28.0.4
- Docker Compose => 1.29.2

### Instalação

1. **Na raiz do projeto:**
   ```bash
   sudo chown -R 1000:1000 .
   ```

2. **Criar containers e instalar dependências:**
   ```bash
   docker-compose up -d && docker-compose run --rm composer install && docker-compose run --rm node yarn
   ```

3. **Configuração do banco de dados (.env):**
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

4. **Execute as migrações:**
   ```bash
   docker-compose run --rm artisan migrate
   ```

5. **Execute o projeto:**
   ```bash
   docker-compose run --rm -p 5173:5173 node yarn dev --host
   ```
6. **Execute o worker:**
   ```bash
   docker-compose run --rm artisan queue:work
   ```

7. **Acesse o projeto:**
   ```bash
   http://localhost
   ```

## Critérios de Avaliação

### Obrigatórios
- [X] CRUD completo de tarefas funcionando
- [X] Interface baseada no design fornecido
- [X] Sistema de filas implementado
- [X] Cache implementado com invalidação
- [X] Soft deletes funcionando
- [X] Código limpo e bem estruturado

### Diferenciais
- [ ] Testes unitários/feature
- [X] Tratamento de erros robusto
- [X] Validações frontend e backend (Backend apenas)
- [X] Responsividade da interface
- [X] Documentação de código
- [X] Otimizações de performance

## Estrutura de Entrega

### Arquivos criados

1. **Backend:**
   - [x] `app/Models/Task.php`
   - [x] `app/Http/Controllers/TaskController.php`
   - [x] `app/Jobs/DeleteCompletedTask.php`
   - [x] `database/migrations/xxxx_create_tasks_table.php`
   - [x] `routes/api.php` (adição das rotas)
   - [x] `app/Http/Requests/TaskUpSertRequest.php`


2. **Frontend:**
   - [x] `resources/js/stores/taskStore.js`
   - [x] `resources/js/stores/alertStore.js`
   - [x] `resources/js/helpers/index.js`
   - [ ] `resources/js/services/taskService.js`
   - [x] `resources/js/components/TaskList.vue`
   - [x] `resources/js/components/TaskModal.vue`
   - [x] `resources/js/components/Alert.vue`
   - [x] Atualização do `TasksContainer.vue`

### Observação
- Projeto demonstra um conhecimento adicional por ter sido estruturado em Docker
- Servidor utilizado pelo Docker é o NGINX
- Layout utilizado possui feedback visual para validação dos campos e para o formulário salvo
- Component de Alert foi criado para dar um feedback das ações do sistema
- A parte mais complexa do código está no arquivo TaskController, deixei comentários explicando a lógica
- Realizei uma validação mais robusta pelo backend no arquivo TaskUpSertRequest, validação do front-end só não foi realizada para aproveitar o tempo com features mais importantes
- Sugiro executar o projeto em uma máquina Linux
- Acredito que o projeto também possa ser executado sem o docker, mas não realizei esse teste


