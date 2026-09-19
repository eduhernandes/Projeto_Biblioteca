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

## 6. Prioridade estratégica

A primeira melhoria que deve ser implementada é o login e a proteção de acesso. Sem essa camada, qualquer refatoração visual ou estrutural do sistema corre o risco de expor páginas internas sem autenticação e de complicar a validação das operações principais.

A ordem correta de execução é:

1. login e autenticação;
2. proteção das páginas internas;
3. layout e menu lateral;
4. listagens e módulos;
5. formulários e feedback;
6. exemplares e empréstimos;
7. revisão de segurança, dados e histórico.

Essa sequência reduz risco, mantém o sistema funcional e permite evoluir sem quebrar o fluxo de uso atual.

---

## 7. Checklist por ordem de prioridade

- [ ] 1. Criar `login.php`, `autenticar.php`, `logout.php` e a tabela `usuarios`.
- [ ] 2. Implementar `session_start()`, proteção por sessão e redirecionamento para login.
- [ ] 3. Validar que usuários sem sessão não consigam acessar páginas internas.
- [ ] 4. Ajustar a visualização base do sistema com layout lateral e área principal.
- [ ] 5. Aplicar o menu lateral em todas as páginas internas após o login.
- [ ] 6. Padronizar listagens de leitores, livros e empréstimos com cabeçalho e ações por linha.
- [ ] 7. Integrar formulários de cadastro e edição ao mesmo padrão visual do módulo.
- [ ] 8. Padronizar mensagens de sucesso, erro, informação e confirmação.
- [ ] 9. Revisar textos, links e navegação entre módulo e módulo.
- [ ] 10. Validar a responsividade do layout em telas pequenas.
- [ ] 11. Criar a estrutura de exemplares e o script de migração para o banco.
- [ ] 12. Adaptar empréstimos para usar `CodExemplar` e manter integridade do histórico.
- [ ] 13. Executar testes manuais de segurança, navegação e consistência dos dados.

---

## 8. Fase 0 — Login e proteção de acesso

### Objetivo

Criar uma tela de login como primeira tela do sistema, permitindo acesso somente a usuários autenticados. Depois do login, o usuário será encaminhado para a página inicial com o menu lateral.

### Fluxo proposto

```text
login.php
   |
   +-- credenciais válidas --> index.php
   |
   +-- credenciais inválidas --> mensagem de erro na própria tela
```

Todas as páginas internas deverão verificar a sessão antes de exibir o conteúdo. Usuários sem sessão serão redirecionados para `login.php`.

### Estrutura mínima recomendada

```text
/
├── login.php              # formulário de usuário e senha
├── autenticar.php         # validação das credenciais
├── logout.php             # encerra a sessão
├── auth/
│   ├── iniciar.php        # session_start e funções simples de sessão
│   └── proteger.php       # bloqueia páginas sem autenticação
└── users/
    └── ...                # cadastro administrativo, se necessário no futuro
```

### Regras de segurança

- a senha nunca deve ser salva nem comparada em texto puro;
- usar `password_hash()` para armazenamento e `password_verify()` para autenticação;
- usar `session_start()` após a validação inicial;
- regenerar o ID da sessão após o login;
- destruir a sessão ao sair;
- limitar a validação aos métodos esperados (`POST` para autenticação);
- não informar se o usuário ou a senha está incorreto;
- usar prepared statements em todas as consultas de autenticação;
- exibir mensagem simples e amigável sem revelar detalhes do banco;
- proteger todas as páginas internas antes de qualquer alteração visual.

### Tabela sugerida

Criar uma tabela de usuários, por exemplo `usuarios`, contendo no mínimo:

- `CodUsuario` — chave primária com incremento automático;
- `Usuario` — nome de login único;
- `Senha` — hash da senha;
- `Nome` — nome exibido na sessão;
- `Ativo` — indica se o acesso está habilitado.

O banco deverá possuir índice `UNIQUE` para `Usuario`.

### Critérios de aceite do login

- o sistema abre em `login.php`;
- credenciais válidas levam ao painel inicial;
- credenciais inválidas permanecem na tela com mensagem clara;
- páginas de leitores, livros e empréstimos não abrem sem sessão;
- `Sair` encerra a sessão e retorna ao login;
- o acesso fica protegido antes de qualquer etapa de melhoria visual.

---

## 9. Fase 1 — Base visual do sistema

### Objetivo

Criar a estrutura visual comum do sistema com menu lateral fixo em telas grandes e responsivo em telas menores.

### Entregas

1. criar no `style.css` as regras do layout com menu lateral;
2. definir o espaçamento, bordas, cores, estados de foco e responsividade;
3. preservar as classes atuais existentes durante a transição;
4. garantir que o sistema continue funcionando sem remover estilos antigos antes da migração total;
5. manter consistência entre as páginas internas após autenticação.

### Estrutura visual recomendada

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

### Classes sugeridas

- `.app-layout`; 
- `.sidebar`; 
- `.sidebar-brand`; 
- `.sidebar-nav`; 
- `.sidebar-link`; 
- `.sidebar-link.active`; 
- `.main-content`; 
- `.page-header`; 
- `.content-card`; 
- `.table-wrapper`; 
- `.action-group`; 
- `.button.danger`; 
- `.empty-state`; 
- `.alert.success`; 
- `.alert.error`; 
- `.alert.info`; 
- `.confirm-action`.

### Regras de UX

- menu lateral à esquerda em telas grandes;
- menu em faixa superior ou layout adaptado em telas pequenas;
- destacar a página atual no menu;
- manter textos objetivos: `Início`, `Empréstimos`, `Livros` e `Leitores`;
- apontar diretamente para as páginas de listagem;
- não depender de bibliotecas externas ou ícones obrigatórios;
- garantir legibilidade e contraste adequados.

---

## 10. Fase 2 — Listagens e páginas principais dos módulos

### Objetivo

Transformar as páginas de módulo em uma estrutura principal clara, com título, ação de cadastro e tabela ou lista de registros.

### Padrão recomendado por módulo

Para cada módulo, a listagem deve ter:

1. cabecalho com o título do módulo;
2. botão de cadastro no topo;
3. tabela de registros abaixo;
4. ações de editar e excluir na própria linha;
5. estado vazio visual claro quando não houver registros;
6. rolagem horizontal em telas pequenas;
7. uso do CSS compartilhado e não de atributos HTML de apresentação.

### Entregas por módulo

- `readers/listar.php` com o padrão de leitores;
- `books/listar.php` com o padrão de livros;
- `loans/listar.php` com o padrão de empréstimos.

### Melhorias de navegação

- evitar voltar para a tela inicial para executar ações principais;
- manter o menu fixo e consistente em todas as páginas internas;
- usar nomes claros em botões e títulos, como `Novo leitor`, `Novo livro` e `Novo empréstimo`;
- remover links duplicados ou telas intermediárias sem necessidade.

---

## 11. Fase 3 — Formulários e feedback visual

### Objetivo

Integrar cadastro e edição ao mesmo padrão visual das listagens, preservando a funcionalidade existente.

### Entregas

- padronizar formulários de `form.php` e `editar.php`;
- manter o menu lateral e o mesmo cabeçalho visual;
- padronizar botões `Salvar`, `Cancelar` e `Voltar`;
- posicionar mensagens de validação próximas ao campo adequado;
- preservar os nomes dos campos e destinos atuais dos formulários;
- garantir que o fluxo de cancelamento retorne à listagem correta.

### Feedbacks do sistema

Criar classes e mensagens consistentes para:

- `.alert.success`;
- `.alert.error`;
- `.alert.info`;
- `.confirm-action`.

As ações de cadastro, atualização e exclusão devem:

- informar claramente o resultado da operação;
- oferecer retorno para a listagem;
- evitar mostrar erros técnicos ao usuário final;
- manter o mesmo padrão visual do restante do sistema.

---

## 12. Fase 4 — Melhorias de navegação e usabilidade

### Objetivo

Melhorar a qualidade do sistema sem aumentar a complexidade técnica do projeto.

### Melhorias recomendadas

1. adicionar `aria-current="page"` ao link ativo do menu;
2. usar `type="button"` quando o botão não enviar formulário;
3. adicionar `aria-label` às ações de edição e exclusão quando necessário;
4. manter confirmação antes de exclusões;
5. usar `htmlspecialchars` em valores exibidos;
6. preservar prepared statements nas operações de banco;
7. validar se o identificador recebido existe antes de editar ou excluir;
8. evitar mensagens de erro do banco diretamente no HTML público.

### Revisão de textos e consistência

- usar português consistente em títulos e botões;
- preferir `Início` em vez de `Home`;
- revisar todos os links relativos entre raiz e subpastas;
- remover caminhos duplicados ou telas intermediárias sem necessidade;
- ajustar a experiência para telas menores e dispositivos com resolução reduzida.

---

## 13. Fase 5 — Cadastro e controle de exemplares

### Objetivo

Separar o cadastro bibliográfico do controle físico dos exemplares. Um registro em `livros` representa o título da obra; cada registro em `exemplares` representa uma cópia física.

### Modelo sugerido de dados

Criar a tabela `exemplares` com:

- `CodExemplar` — identificador único do exemplar;
- `CodLivro` — chave estrangeira para `livros.CodLivro`;
- `Status` — código numérico do estado atual.

Os códigos de status devem ser:

| Código | Nome | Uso |
|---:|---|---|
| 1 | Disponível | Pode ser selecionado para um novo empréstimo |
| 2 | Emprestado | Está associado a um empréstimo em aberto |
| 3 | Inativo | Não deve ser emprestado, mas permanece no histórico |

### Regras de negócio

- o livro pode ser cadastrado sem criar o exemplar no mesmo momento;
- cada livro pode ter vários exemplares;
- exemplares emprestados não podem ser reutilizados antes da devolução;
- exemplares inativos não aparecem como opção de novo empréstimo;
- histórico deve permanecer consultável mesmo que o exemplar ou livro não esteja mais disponível;
- a exclusão não deve remover dados necessários ao histórico.

### Fluxo proposto

1. Usuário acessa `Livros`.
2. A listagem exibe os livros cadastrados.
3. Cada linha apresenta `Editar`, `Exemplares` e, quando aplicável, `Excluir`.
4. `Exemplares` abre uma página própria, por exemplo `books/exemplares.php?codlivro=...`.
5. A página mostra os exemplares daquele livro.
6. O usuário seleciona `Cadastrar exemplar`.
7. O sistema cria um exemplar com status inicial `1 - Disponível`.
8. A mesma página permite alterar o status para `Inativo`, respeitando as regras de empréstimo.

### Alteração no empréstimo

O empréstimo deve apontar para `exemplares.CodExemplar` em vez de `livros.CodLivro`.

Alterações planejadas:

1. substituir `emprestimos.CodLivro` por `emprestimos.CodExemplar`;
2. criar chave estrangeira para `exemplares`;
3. no formulário de empréstimo, selecionar leitor e exemplar disponível;
4. exibir o título do livro junto com o código do exemplar;
5. confirmar no servidor que o exemplar está com status `1` antes de cadastrar;
6. inserir o empréstimo e alterar o exemplar para status `2`;
7. na devolução, registrar a data e alterar o exemplar para status `1`;
8. evitar novo empréstimo de exemplar com status `2` ou `3`;
9. manter o histórico mesmo quando o exemplar ou livro não estiver mais disponível.

### Migração dos dados existentes

Antes de alterar a tabela `emprestimos`, criar um roteiro de migração:

1. criar a tabela `exemplares`;
2. criar um exemplar disponível para cada livro existente ou para a quantidade real conhecida;
3. relacionar empréstimos antigos a exemplares correspondentes;
4. trocar a coluna de livro por exemplar somente após validar os dados;
5. confirmar que os registros migrados ficam íntegros;
6. remover a coluna antiga somente após garantir que nenhum histórico depende dela.

Não executar a migração diretamente no código da aplicação. Criar um script SQL versionado em `database/` e fazer backup do banco antes da alteração.

### Critérios de aceite dos exemplares

- é possível cadastrar um livro sem criar o exemplar no mesmo formulário;
- a listagem de livros possui a ação `Exemplares`;
- a página de exemplares identifica claramente o livro selecionado;
- novo exemplar começa como `Disponível`;
- exemplares `Emprestados` não podem ser emprestados novamente;
- exemplares `Inativos` não aparecem como opção de novo empréstimo;
- o empréstimo mostra o livro e o exemplar;
- a devolução libera o exemplar;
- históricos continuam consultáveis;
- a exclusão não remove dados necessários para o histórico.

---

## 14. Fase 6 — Validação final e testes manuais

### Objetivo

Verificar se a melhoria foi concluída sem quebrar o funcionamento atual do sistema.

### Testes recomendados

- abrir a página inicial e confirmar que o sistema inicia no login;
- validar credenciais válidas e inválidas;
- testar acesso sem sessão para todas as páginas internas;
- navegar por cada módulo pelo menu lateral;
- cadastrar, editar e excluir leitores e livros;
- confirmar que o módulo ativo permanece destacado;
- verificar tabelas e formulários em telas menores;
- testar lista vazia e mensagens de feedback;
- confirmar que empréstimos e exemplares continuam consistentes;
- revisar histórico, devolução e status após a mudança para exemplares.

---

## 15. Critérios de aceite do plano completo

A implementação será considerada concluída quando:

- o sistema abrir em `login.php` e exigir autenticação;
- todas as páginas internas ficarem protegidas por sessão;
- o menu lateral aparecer e indicar o módulo ativo;
- os quatro itens solicitados estarem presentes: `Início`, `Empréstimos`, `Livros` e `Leitores`;
- as listagens principais mostrarem botão de cadastro e ações de linha;
- cadastro e edição ficarem visualmente integrados ao módulo;
- os módulos funcionarem sem novas dependências;
- o layout permanecer utilizável em telas pequenas;
- a estrutura de exemplares e o fluxo de empréstimos ficarem consistentes;
- nenhuma operação de cadastro, edição, exclusão ou consulta for quebrada.

---

## 16. Ordem final recomendada de implementação

1. implementar sessão, tabela `usuarios`, `login.php`, `autenticar.php` e `logout.php`;
2. proteger todas as páginas internas e validar acesso pelo XAMPP;
3. aplicar o menu lateral e a base visual do sistema;
4. migrar as listagens para o novo layout;
5. migrar formulários e mensagens dos módulos;
6. revisar textos, navegação e responsividade;
7. criar a tabela `exemplares` e o script de migração;
8. criar a tela de exemplares vinculada à listagem de livros;
9. adaptar cadastro, listagem e devolução de empréstimos para usar exemplares;
10. revisar exclusões, status e histórico;
11. executar os testes finais de segurança, navegação e consistência dos dados.

Essa ordem preserva o funcionamento do sistema e garante que o login e a segurança sejam a base de toda a evolução visual e funcional do projeto.

---

## 17. Cronograma sugerido por sprint

### Sprint 1 — Segurança e acesso

- [X] criar a tabela `usuarios`;
- [x] implementar `login.php`, `autenticar.php` e `logout.php`;
- [x] aplicar `session_start()` e proteção por sessão;
- [x] validar redirecionamento para login quando não houver sessão;
- [x] testar login válido e inválido no XAMPP.

Entrega: o sistema passa a exigir autenticação antes de abrir qualquer página interna.

### Sprint 2 — Reorganização da estrutura do projeto

Checklist operacional:

- [ ] 1. Mapear a estrutura atual de pastas, arquivos e rotas do sistema;
- [ ] 2. Identificar duplicações de código entre livros, leitores e empréstimos;
- [ ] 3. Definir uma padronização por módulo: listagem, cadastro, processamento e navegação;
- [ ] 4. Separar responsabilidades de banco, autenticação e páginas públicas/privadas;
- [ ] 5. Organizar os arquivos para reduzir dependências entre módulos e evitar caminhos inconsistentes;
- [ ] 6. Revisar o fluxo de navegação entre as páginas internas para eliminar redundâncias;
- [ ] 7. Criar padrões reutilizáveis para conexão com banco, sessão e validações simples;
- [ ] 8. Revisar os links principais do sistema para garantir que o acesso siga o fluxo correto;
- [ ] 9. Registrar a nova estrutura no projeto para facilitar manutenção posterior;
- [ ] 10. Validar que a autenticação continua funcionando após a reorganização.

Entrega: o projeto passa a ter uma estrutura mais clara, reutilizável e preparada para evoluir sem acúmulo de código duplicado.

Critérios de aceite do Sprint 2:
- os arquivos de cada módulo ficam agrupados por responsabilidade;
- há menos duplicação entre operações de cadastro, edição e listagem;
- a navegação entre módulos é consistente e previsível;
- a base de autenticação e banco permanece protegida e funcional;
- a estrutura resultante está pronta para receber a padronização visual do Sprint 3;
- a organização do projeto fica clara para manutenção e futuras evoluções.

### Sprint 3 — Layout base e navegação

- [ ] ajustar `style.css` com o layout principal;
- [ ] aplicar menu lateral em todas as páginas internas;
- [ ] padronizar cabeçalhos, ações e páginas de listagem;
- [ ] revisar responsividade e usabilidade em telas menores;
- [ ] validar links e navegação entre módulos.

Entrega: o sistema ganha uma estrutura visual comum e consistente.

### Sprint 4 — Módulos e formulários

- [ ] migrar `readers/listar.php`, `books/listar.php` e `loans/listar.php`;
- [ ] padronizar formulários de cadastro e edição;
- [ ] ajustar botões e mensagens de feedback;
- [ ] confirmar cancelamento e retorno correto para listagem;
- [ ] revisar textos e consistência do português.

Entrega: leitores, livros e empréstimos passam a operar no mesmo padrão visual.

### Sprint 5 — Exemplar e integração funcional

- [ ] criar a tabela `exemplares` e o script de migração;
- [ ] criar a tela de exemplares vinculada a cada livro;
- [ ] adaptar empréstimos para usar `CodExemplar`;
- [ ] validar regras de disponibilidade, devolução e histórico;
- [ ] testar cenários de cadastro, edição, exclusão e status final.

Entrega: o fluxo completo de livros e empréstimos fica consistente com o controle físico dos exemplares.

### Sprint 6 — Testes finais e revisão

- [ ] executar testes de segurança, autenticação e autorização;
- [ ] verificar telas vazias, erros e mensagens visuais;
- [ ] revisar histórico e integridade dos dados;
- [ ] confirmar que o sistema continua funcionando sem dependências novas;
- [ ] fechar ajustes finais antes da entrega.

Entrega: versão estável, protegida, navegável e funcional.

---

