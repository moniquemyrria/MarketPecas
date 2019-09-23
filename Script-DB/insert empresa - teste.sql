USE [MKTPECAS_2]
GO

INSERT INTO [dbo].[usuario]
           ([email]
           ,[senha]
           ,[tipo_pessoa]
           ,[ativo])
     VALUES
           ('empresa@gmail.com'
           ,'123'
           ,'J'
           ,'S')
GO

USE [MKTPECAS_2]
GO

INSERT INTO [dbo].[contato]
           ([telefone]
           ,[whatsapp]
           ,[email]
           ,[facebook])
     VALUES
           ('(92)98152-6525'
           ,'(92)9943303-13'
           ,'empresa@gmail.com'
           ,'www.facebook.com.br/empresa')
GO

USE [MKTPECAS_2]
GO

INSERT INTO [dbo].[endereco]
           ([logradouro]
           ,[numero]
           ,[bairro]
           ,[cep])
     VALUES
           ('RUA VASCO VASQUES'
           ,'01'
           ,'PARQUE 10'
           ,'69065-020')
GO


USE [MKTPECAS_2]
GO

INSERT INTO [dbo].[empresa]
           ([id_usuario]
           ,[id_endereco]
           ,[id_contato]
           ,[cnpj]
           ,[razao_social]
           ,[nome_fantasia]
           ,[observacao]
           ,[forma_pgto_dinheiro]
           ,[forma_pgto_cartao_credito]
           ,[forma_pgto_cartao_debito]
           ,[forma_pgto_boleto]
           ,[forma_pgto_crediario_proprio]
           ,[loja_linha_leve]
           ,[loja_linha_pesada]
           ,[cobre_oferta_praca])
     VALUES
           (1
           ,1
           ,1
           ,'04.302.118.0001-25'
           ,'EMPRESA TESTE'
           ,'EMPRESA TESTE'
           ,'TESTE OBS'
           ,'S'
           ,'S'
           ,'S'
           ,'S'
           ,'S'
           ,'S'
           ,'S'
           ,'S')
GO


