USE [MKTPECAS_3]
GO
SET IDENTITY_INSERT [dbo].[categoria] ON 

INSERT [dbo].[categoria] ([id], [descricao]) VALUES (1, N'ACESSORIOS')
INSERT [dbo].[categoria] ([id], [descricao]) VALUES (2, N'OLEOS')
INSERT [dbo].[categoria] ([id], [descricao]) VALUES (3, N'BATERIAS')
SET IDENTITY_INSERT [dbo].[categoria] OFF
SET IDENTITY_INSERT [dbo].[marca] ON 

INSERT [dbo].[marca] ([id], [descricao]) VALUES (1, N'COFAP')
INSERT [dbo].[marca] ([id], [descricao]) VALUES (2, N'MOURA')
INSERT [dbo].[marca] ([id], [descricao]) VALUES (3, N'ACEDELCO')
SET IDENTITY_INSERT [dbo].[marca] OFF
