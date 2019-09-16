USE [MKTPECAS]
GO
/****** Object:  Table [dbo].[avaliacao_empresa]    Script Date: 16/09/2019 00:16:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[avaliacao_empresa](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_cliente] [int] NOT NULL,
	[id_empresa] [int] NOT NULL,
	[avaliacao] [nchar](1) NOT NULL,
 CONSTRAINT [PK_avaliacao_empresa] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[categoria]    Script Date: 16/09/2019 00:16:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[categoria](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[descricao] [varchar](100) NOT NULL,
 CONSTRAINT [PK_categoria] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cliente]    Script Date: 16/09/2019 00:16:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cliente](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[oferta_app] [nchar](1) NOT NULL,
	[id_usuario] [int] NOT NULL,
 CONSTRAINT [PK_cliente] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cotacao]    Script Date: 16/09/2019 00:16:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cotacao](
	[id] [int] IDENTITY(1,1) NOT NULL,
 CONSTRAINT [PK_cotacao] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[empresa]    Script Date: 16/09/2019 00:16:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[empresa](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_usuario] [int] NOT NULL,
	[cnpj] [nchar](20) NOT NULL,
	[razao_social] [varchar](100) NOT NULL,
	[nome_fantasia] [varchar](100) NOT NULL,
	[telefone] [varchar](14) NOT NULL,
	[observacao] [varchar](300) NOT NULL,
	[forma_pgto_dinheiro] [nchar](1) NOT NULL,
	[forma_pgto_cartao_credito] [nchar](1) NOT NULL,
	[forma_pgto_cartao_debito] [nchar](1) NOT NULL,
	[forma_pgto_boleto] [nchar](1) NOT NULL,
	[forma_pgto_crediario_proprio] [nchar](1) NOT NULL,
	[loja_linha_leve] [nchar](1) NOT NULL,
	[loja_linha_pesada] [nchar](1) NOT NULL,
	[cobre_oferta_praca] [nchar](1) NOT NULL,
	[logradouro] [varchar](200) NOT NULL,
	[numero] [varchar](10) NOT NULL,
	[bairro] [varchar](100) NOT NULL,
	[cep] [varchar](10) NOT NULL,
 CONSTRAINT [PK_empresa] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[itens_cotacao]    Script Date: 16/09/2019 00:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[itens_cotacao](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_cotacao] [int] NOT NULL,
	[id_produto] [int] NOT NULL,
 CONSTRAINT [PK_itens_cotacao] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[itens_oferta_produto]    Script Date: 16/09/2019 00:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[itens_oferta_produto](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_oferta_produto] [int] NOT NULL,
	[id_produto] [int] NOT NULL,
	[preco] [float] NOT NULL,
 CONSTRAINT [PK_itens_oferta_produto] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[marca]    Script Date: 16/09/2019 00:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[marca](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[descricao] [varchar](100) NOT NULL,
 CONSTRAINT [PK_marca] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[oferta_produto]    Script Date: 16/09/2019 00:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[oferta_produto](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[ativa] [nchar](1) NOT NULL,
 CONSTRAINT [PK_oferta_produto] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[produto]    Script Date: 16/09/2019 00:16:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[produto](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_categoria] [int] NOT NULL,
	[id_marca] [int] NOT NULL,
	[codigo] [varchar](20) NOT NULL,
	[descricao] [varchar](100) NOT NULL,
	[aplicacao] [varchar](300) NOT NULL,
	[unidade_medida] [varchar](4) NOT NULL,
	[altura] [varchar](20) NULL,
	[largura] [varchar](20) NULL,
	[comprimento] [varchar](20) NULL,
	[peso] [varchar](20) NULL,
	[data_cadastro] [date] NOT NULL,
	[deletado] [nchar](1) NOT NULL,
	[preco] [float] NOT NULL,
	[imagem] [varchar](max) NULL,
	[id_empresa] [int] NULL,
 CONSTRAINT [PK_produto] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[usuario]    Script Date: 16/09/2019 00:16:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[usuario](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[email] [varchar](50) NOT NULL,
	[senha] [varchar](50) NOT NULL,
	[tipo_pessoa] [nchar](1) NOT NULL,
	[ativo] [nchar](1) NULL,
 CONSTRAINT [PK_usuario] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[categoria] ON 

INSERT [dbo].[categoria] ([id], [descricao]) VALUES (1, N'BATERIAS')
INSERT [dbo].[categoria] ([id], [descricao]) VALUES (2, N'ADITIVOS')
INSERT [dbo].[categoria] ([id], [descricao]) VALUES (3, N'PNEUS')
SET IDENTITY_INSERT [dbo].[categoria] OFF
SET IDENTITY_INSERT [dbo].[marca] ON 

INSERT [dbo].[marca] ([id], [descricao]) VALUES (1, N'MOURA')
INSERT [dbo].[marca] ([id], [descricao]) VALUES (2, N'COFAP')
SET IDENTITY_INSERT [dbo].[marca] OFF
ALTER TABLE [dbo].[avaliacao_empresa]  WITH CHECK ADD  CONSTRAINT [FK_avaliacao_empresa_cliente] FOREIGN KEY([id_cliente])
REFERENCES [dbo].[cliente] ([id])
GO
ALTER TABLE [dbo].[avaliacao_empresa] CHECK CONSTRAINT [FK_avaliacao_empresa_cliente]
GO
ALTER TABLE [dbo].[avaliacao_empresa]  WITH CHECK ADD  CONSTRAINT [FK_avaliacao_empresa_empresa] FOREIGN KEY([id_empresa])
REFERENCES [dbo].[empresa] ([id])
GO
ALTER TABLE [dbo].[avaliacao_empresa] CHECK CONSTRAINT [FK_avaliacao_empresa_empresa]
GO
ALTER TABLE [dbo].[cliente]  WITH CHECK ADD  CONSTRAINT [FK_cliente_usuario] FOREIGN KEY([id_usuario])
REFERENCES [dbo].[usuario] ([id])
GO
ALTER TABLE [dbo].[cliente] CHECK CONSTRAINT [FK_cliente_usuario]
GO
ALTER TABLE [dbo].[empresa]  WITH CHECK ADD  CONSTRAINT [FK_empresa_usuario] FOREIGN KEY([id_usuario])
REFERENCES [dbo].[usuario] ([id])
GO
ALTER TABLE [dbo].[empresa] CHECK CONSTRAINT [FK_empresa_usuario]
GO
ALTER TABLE [dbo].[itens_cotacao]  WITH CHECK ADD  CONSTRAINT [FK_itens_cotacao_cotacao] FOREIGN KEY([id_cotacao])
REFERENCES [dbo].[cotacao] ([id])
GO
ALTER TABLE [dbo].[itens_cotacao] CHECK CONSTRAINT [FK_itens_cotacao_cotacao]
GO
ALTER TABLE [dbo].[itens_cotacao]  WITH CHECK ADD  CONSTRAINT [FK_itens_cotacao_produto] FOREIGN KEY([id_produto])
REFERENCES [dbo].[produto] ([id])
GO
ALTER TABLE [dbo].[itens_cotacao] CHECK CONSTRAINT [FK_itens_cotacao_produto]
GO
ALTER TABLE [dbo].[itens_oferta_produto]  WITH CHECK ADD  CONSTRAINT [FK_itens_oferta_produto_oferta_produto] FOREIGN KEY([id])
REFERENCES [dbo].[oferta_produto] ([id])
GO
ALTER TABLE [dbo].[itens_oferta_produto] CHECK CONSTRAINT [FK_itens_oferta_produto_oferta_produto]
GO
ALTER TABLE [dbo].[itens_oferta_produto]  WITH CHECK ADD  CONSTRAINT [FK_itens_oferta_produto_produto] FOREIGN KEY([id_produto])
REFERENCES [dbo].[produto] ([id])
GO
ALTER TABLE [dbo].[itens_oferta_produto] CHECK CONSTRAINT [FK_itens_oferta_produto_produto]
GO
ALTER TABLE [dbo].[produto]  WITH CHECK ADD  CONSTRAINT [FK_produto_categoria] FOREIGN KEY([id_categoria])
REFERENCES [dbo].[categoria] ([id])
GO
ALTER TABLE [dbo].[produto] CHECK CONSTRAINT [FK_produto_categoria]
GO
ALTER TABLE [dbo].[produto]  WITH CHECK ADD  CONSTRAINT [FK_produto_empresa] FOREIGN KEY([id_empresa])
REFERENCES [dbo].[empresa] ([id])
GO
ALTER TABLE [dbo].[produto] CHECK CONSTRAINT [FK_produto_empresa]
GO
ALTER TABLE [dbo].[produto]  WITH CHECK ADD  CONSTRAINT [FK_produto_marca] FOREIGN KEY([id_marca])
REFERENCES [dbo].[marca] ([id])
GO
ALTER TABLE [dbo].[produto] CHECK CONSTRAINT [FK_produto_marca]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'B - Bom

M - Medio

R - Regular

O - Otimo' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'avaliacao_empresa', @level2type=N'COLUMN',@level2name=N'avaliacao'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Nao' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cliente', @level2type=N'COLUMN',@level2name=N'oferta_app'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'empresa', @level2type=N'COLUMN',@level2name=N'forma_pgto_dinheiro'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'empresa', @level2type=N'COLUMN',@level2name=N'forma_pgto_cartao_credito'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'empresa', @level2type=N'COLUMN',@level2name=N'forma_pgto_cartao_debito'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'empresa', @level2type=N'COLUMN',@level2name=N'forma_pgto_boleto'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'empresa', @level2type=N'COLUMN',@level2name=N'forma_pgto_crediario_proprio'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'empresa', @level2type=N'COLUMN',@level2name=N'loja_linha_leve'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'empresa', @level2type=N'COLUMN',@level2name=N'loja_linha_pesada'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'empresa', @level2type=N'COLUMN',@level2name=N'cobre_oferta_praca'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'oferta_produto', @level2type=N'COLUMN',@level2name=N'ativa'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'F - Fisico
J - Juridico' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'usuario', @level2type=N'COLUMN',@level2name=N'tipo_pessoa'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'S - Sim
N - Não' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'usuario', @level2type=N'COLUMN',@level2name=N'ativo'
GO
