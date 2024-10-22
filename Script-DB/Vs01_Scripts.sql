USE [MKTPECAS]
GO
/****** Object:  Table [dbo].[categoria]    Script Date: 05/09/2019 23:38:19 ******/
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
/****** Object:  Table [dbo].[marca]    Script Date: 05/09/2019 23:38:20 ******/
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
/****** Object:  Table [dbo].[produto]    Script Date: 05/09/2019 23:38:20 ******/
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
	[imagem] [image] NULL,
	[data_cadastro] [date] NOT NULL,
	[deletado] [nchar](1) NOT NULL,
 CONSTRAINT [PK_produto] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
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
SET IDENTITY_INSERT [dbo].[produto] ON 

INSERT [dbo].[produto] ([id], [id_categoria], [id_marca], [codigo], [descricao], [aplicacao], [unidade_medida], [altura], [largura], [comprimento], [peso], [imagem], [data_cadastro], [deletado]) VALUES (2, 1, 1, N'123', N'TESTE', N'TESTE', N'123', N'', N'', N'', N'', 0x, CAST(N'2019-09-06' AS Date), N'N')
INSERT [dbo].[produto] ([id], [id_categoria], [id_marca], [codigo], [descricao], [aplicacao], [unidade_medida], [altura], [largura], [comprimento], [peso], [imagem], [data_cadastro], [deletado]) VALUES (3, 1, 1, N'789', N'TESTANDO', N'TESTANDOOO', N'123', N'', N'', N'', N'', 0x, CAST(N'2019-09-06' AS Date), N'N')
SET IDENTITY_INSERT [dbo].[produto] OFF
ALTER TABLE [dbo].[produto]  WITH CHECK ADD  CONSTRAINT [FK_produto_categoria] FOREIGN KEY([id_categoria])
REFERENCES [dbo].[categoria] ([id])
GO
ALTER TABLE [dbo].[produto] CHECK CONSTRAINT [FK_produto_categoria]
GO
ALTER TABLE [dbo].[produto]  WITH CHECK ADD  CONSTRAINT [FK_produto_marca] FOREIGN KEY([id_marca])
REFERENCES [dbo].[marca] ([id])
GO
ALTER TABLE [dbo].[produto] CHECK CONSTRAINT [FK_produto_marca]
GO
