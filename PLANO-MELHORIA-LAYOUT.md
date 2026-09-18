# Plano de melhoria do layout do Sistema Biblioteca

## 1. Objetivo

Reduzir a sensação de excesso de páginas e deixar o sistema mais profissional, mantendo a tecnologia atual:

- PHP procedural já utilizado no projeto;
- HTML sem framework;
- CSS compartilhado em `style.css`;
- banco de dados e consultas existentes;
- nenhuma nova biblioteca, linguagem ou dependência obrigatória.

A proposta principal é criar uma estrutura visual com menu lateral fixo em telas grandes e adaptável em telas menores. O menu terá:

1. Início;
2. Empréstimos;
3. Livros;
4. Leitores.

Ao selecionar um módulo, a página principal do módulo deverá exibir a listagem dos registros, uma ação de cadastro e as ações disponíveis para cada item.

---

## 2. Estado atual observado

Atualmente, a navegação está distribuída entre várias páginas independentes:

- `index.html` apresenta grupos de botões para cada módulo;
- cada página possui um cabeçalho próprio com botão `Home`;
- leitores, livros e empréstimos têm páginas de listagem e formulário separadas;
- as listagens já possuem ações de edição/exclusão em alguns módulos;
- o CSS é compartilhado, mas ainda trata cada tela como uma página isolada;
- o formulário de leitores em `readers/form.php` é uma tela exclusiva de cadastro, em vez de uma área integrada ao fluxo de leitores.

Essa estrutura funciona, mas obriga o usuário a voltar para a página inicial ou conhecer muitos caminhos diferentes.

---

## 3. Resultado esperado

O sistema deverá ter uma casca visual comum em todas as páginas:

```text
+------------------------------------------------------+
| Logo / Sistema Biblioteca                            |
+------------------+-----------------------------------+
| Início           | Título da página                  |
| Empréstimos      | Ações principais                   |
| Livros           | Conteúdo: tabela, formulário etc. |
| Leitores         |                                   |
|                  |                                   |
| Sair/rodapé      |                                   |
+------------------+-----------------------------------+
```

Ao abrir **Leitores**, por exemplo:

- o item `Leitores` fica destacado no menu;
- a área principal mostra o título `Leitores`;
- aparece o botão `Cadastrar novo leitor`;
- abaixo fica a tabela de leitores;
- cada linha apresenta as ações `Editar` e `Excluir`;
- se não houver registros, é exibido um estado vazio claro;
- a página não precisa retornar à tela inicial para realizar as ações principais.

O mesmo padrão deve ser aplicado a livros e empréstimos.

---

## 4. Estrutura visual proposta

### 4.1. Layout comum

Criar classes reutilizáveis no `style.css`:

- `.app-layout`: contêiner geral da aplicação;
- `.sidebar`: menu lateral;
- `.sidebar-brand`: identificação do sistema;
- `.sidebar-nav`: lista de navegação;
- `.sidebar-link`: link de cada módulo;
- `.sidebar-link.active`: módulo atual;
- `.main-content`: área de conteúdo;
- `.page-header`: título e ações da página;
- `.content-card`: cartões para tabelas e formulários;
- `.table-wrapper`: rolagem horizontal para tabelas em telas pequenas;
- `.action-group`: agrupamento de ações;
- `.button.danger`: ação de exclusão;
- `.empty-state`: mensagem para lista vazia.

O menu deverá usar links HTML normais. Não é necessário adicionar JavaScript para a primeira versão.

### 4.2. Menu lateral

O menu deverá:

- aparecer à esquerda em telas largas;
- destacar visualmente a página atual;
- possuir textos objetivos: `Início`, `Empréstimos`, `Livros` e `Leitores`;
- apontar diretamente para as páginas de listagem dos módulos;
- manter contraste suficiente entre texto e fundo;
- não depender de ícones externos ou bibliotecas.

### 4.3. Comportamento responsivo

Em telas menores:

- o menu lateral deve ocupar a largura disponível ou transformar-se em uma faixa superior;
- a tabela deve permitir rolagem horizontal sem quebrar a página;
- os botões devem poder ocupar a largura disponível;
- os formulários devem passar para uma coluna;
- o conteúdo não deve exigir zoom para ser utilizado.

---

## 5. Estrutura de páginas recomendada

Não é necessário renomear todos os arquivos imediatamente. A implementação pode começar reaproveitando os caminhos atuais:

```text
/
├── index.php ou index.html
├── style.css
├── db.php
├── readers/
│   ├── listar.php       # tela principal de leitores
│   ├── form.php         # cadastro
│   ├── cadastrar.php    # processamento do cadastro
│   ├── editar.php       # edição
│   ├── atualizar.php    # processamento da edição
│   └── excluir.php      # exclusão
├── books/
│   ├── listar.php       # tela principal de livros
│   └── ...
└── loans/
    ├── listar.php       # tela principal de empréstimos
    └── ...
```

### Recomendação sobre a página inicial

Migrar gradualmente `index.html` para `index.php` apenas se for necessário compartilhar PHP ou informações do banco na página inicial. Caso a página inicial continue estática, ela pode permanecer como HTML.

O ponto importante é que o menu das páginas internas sempre aponte para o caminho correto da página inicial, sem duplicar caminhos diferentes.

---

## 6. Plano de implementação por etapas

### Etapa 1 — Definir a casca visual

1. Criar no `style.css` as regras do layout com menu lateral.
2. Definir cores, espaçamentos, bordas, estados de foco e responsividade.
3. Preservar as classes atuais (`button`, `secondary`, `container` etc.) durante a transição.
4. Garantir que o estilo antigo não seja removido antes de todas as páginas serem migradas.

**Entrega:** layout comum pronto para receber as páginas existentes.

### Etapa 2 — Criar o cabeçalho/menu reutilizável

Como o projeto não utiliza templates ou componentes, há duas opções simples:

#### Opção recomendada para o primeiro momento

Repetir um bloco HTML pequeno do menu em cada página PHP. Essa opção evita aumentar a complexidade e facilita a compreensão para quem está aprendendo.

#### Opção futura

Criar um arquivo PHP parcial, por exemplo `includes/menu.php`, e incluí-lo com `include`. Essa opção reduz repetição, mas deve ser feita somente depois que o layout estiver estável.

**Entrega:** todas as páginas internas com a mesma navegação.

### Etapa 3 — Transformar as listagens em páginas principais

Para cada módulo:

1. usar `listar.php` como entrada do módulo;
2. colocar o título e o botão de novo cadastro no mesmo cabeçalho;
3. manter a tabela abaixo das ações principais;
4. padronizar os nomes das colunas;
5. transformar `Editar` e `Excluir` em botões ou links com classes visuais;
6. remover atributos HTML de apresentação, como `border`, `cellpadding` e `cellspacing`, deixando isso no CSS;
7. adicionar `table` responsiva dentro de `.table-wrapper`;
8. exibir uma mensagem de lista vazia dentro de `.empty-state`.

**Entrega:** `readers/listar.php`, `books/listar.php` e `loans/listar.php` com a mesma estrutura.

### Etapa 4 — Integrar cadastro e edição ao mesmo padrão

Para `form.php` e `editar.php`:

1. manter o menu lateral;
2. usar o mesmo título e cartão de conteúdo das listagens;
3. padronizar os botões `Salvar`, `Cancelar` e `Voltar`;
4. posicionar mensagens de validação próximas ao formulário;
5. preservar os nomes dos campos e os destinos atuais dos formulários;
6. garantir que `Cancelar` retorne à listagem do módulo correto.

**Entrega:** cadastro e edição visualmente integrados ao módulo.

### Etapa 5 — Padronizar feedbacks

Criar classes CSS para:

- `.alert.success`;
- `.alert.error`;
- `.alert.info`;
- `.confirm-action`.

As páginas de cadastro, atualização e exclusão deverão:

- informar claramente o resultado da operação;
- oferecer retorno para a listagem;
- não mostrar mensagens técnicas diretamente ao usuário;
- manter o mesmo cabeçalho e menu das demais páginas.

### Etapa 6 — Revisar textos e navegação

1. Usar português consistente em títulos e botões.
2. Preferir `Início` a misturas como `Home`.
3. Usar nomes de ação claros: `Novo leitor`, `Novo livro`, `Novo empréstimo`.
4. Conferir todos os links relativos entre raiz e subpastas.
5. Remover links duplicados ou que levem a telas intermediárias sem necessidade.

### Etapa 7 — Validação manual

Testar no XAMPP/Apache:

- abrir a página inicial;
- navegar para cada módulo pelo menu;
- cadastrar um leitor, livro e empréstimo;
- editar leitores e livros;
- excluir leitores e livros;
- conferir mensagens de sucesso e erro;
- testar uma lista vazia;
- reduzir a largura do navegador;
- verificar se tabelas e formulários continuam utilizáveis;
- confirmar que o botão do módulo ativo permanece destacado.

---

## 7. Decisões para manter a complexidade baixa

- Não adicionar Bootstrap, Tailwind ou qualquer framework CSS.
- Não adicionar React, Vue, jQuery ou outro JavaScript.
- Não criar uma API nova.
- Não alterar o banco de dados apenas por causa do layout.
- Não misturar a refatoração visual com uma reescrita completa da aplicação.
- Reaproveitar os nomes de arquivos e os endpoints atuais.
- Centralizar primeiro o CSS; só depois avaliar a criação de includes PHP.

---

## 8. Melhorias funcionais pequenas e seguras

Estas melhorias podem acompanhar a mudança visual, sem alterar o escopo principal:

1. adicionar `aria-current="page"` ao link ativo do menu;
2. usar `type="button"` quando o botão não enviar formulário;
3. adicionar `aria-label` às ações de edição e exclusão quando necessário;
4. manter confirmação antes de exclusões;
5. usar `htmlspecialchars` em valores exibidos;
6. preservar prepared statements nas operações de banco;
7. validar se o identificador recebido existe antes de editar ou excluir;
8. evitar mensagens de erro do banco diretamente no HTML público.

---

## 9. Critérios de aceite

A implementação futura será considerada concluída quando:

- todas as páginas internas exibirem o mesmo menu lateral;
- o menu possuir os quatro itens solicitados;
- clicar em `Leitores` abrir diretamente a listagem de leitores;
- a listagem tiver botão de cadastro no topo;
- cada leitor tiver ações de editar e excluir na própria linha;
- livros e empréstimos seguirem o mesmo padrão;
- as páginas funcionarem sem novas dependências;
- a navegação funcionar a partir da raiz e das subpastas;
- o layout continuar utilizável em telas pequenas;
- nenhuma operação existente de cadastro, edição, exclusão ou consulta for quebrada.

---

## 10. Ordem recomendada para a futura implementação

1. atualizar o `style.css`;
2. migrar `readers/listar.php`;
3. migrar `books/listar.php`;
4. migrar `loans/listar.php`;
5. migrar os formulários;
6. migrar as páginas de processamento e feedback;
7. revisar a página inicial;
8. testar todos os fluxos no XAMPP;
9. somente depois avaliar a criação de `includes/menu.php`.

Essa ordem entrega valor rapidamente e reduz o risco de alterar várias áreas do sistema ao mesmo tempo.
