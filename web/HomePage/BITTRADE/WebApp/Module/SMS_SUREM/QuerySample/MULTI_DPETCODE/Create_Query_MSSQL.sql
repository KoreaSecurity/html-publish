/***** CREATE DATA_TABLE *****/
CREATE TABLE [SUREData](
	[SEQNO] [int] IDENTITY(1,1) NOT NULL,
	[INTIME] [char](14) NOT NULL,
	[USERCODE] [char](30) NOT NULL,
	[REQNAME] [varchar](32) NULL,
	[REQPHONE] [varchar](20) NULL,
	[CALLNAME] [varchar](32) NULL,
	[COUNTRY] [varchar](10) NULL,
	[CALLPHONE] [varchar](20) NOT NULL,
	[SUBJECT] [varchar](120) NULL,
	[MSG] [varchar](4000) NOT NULL,
	[REQTIME] [char](14) NOT NULL,
	[SENTTIME] [char](14) NULL,
	[RECVTIME] [char](14) NULL,
	[RESULT] [char](1) NOT NULL CONSTRAINT [DF_SUREData_RESULT]  DEFAULT ('0'),
	[ERRCODE] [int] NULL,
	[KIND] [char](1) NOT NULL,
	[FKCONTENT] [int] NULL,
	[DEPTCODE] [char](30) NOT NULL,
	[BATCHFLAG] [int] NOT NULL CONSTRAINT [DF_SUREData_BatchFlag]  DEFAULT (0),
	[RETRY] [int] NOT NULL DEFAULT (0),
	[TEMPLATECODE] [char](14),
 CONSTRAINT [PK_SUREData] PRIMARY KEY CLUSTERED 
(
	[SEQNO] DESC
) ON [PRIMARY]
) ON [PRIMARY]


/***** CREATE MMSCONTENTS TABLE *****/
CREATE TABLE [MMSContents](
	[SeqNo] [int] IDENTITY(1,1) NOT NULL,
	[FileCnt] [int] NOT NULL CONSTRAINT [DF_MMSContents_FileCnt]  DEFAULT (0),
	[FilePath1] [varchar](255) NULL,
	[FilePath2] [varchar](255) NULL,
	[FilePath3] [varchar](255) NULL,
 CONSTRAINT [PK_MMSContents] PRIMARY KEY CLUSTERED 
(
	[SeqNo] ASC
) ON [PRIMARY]
) ON [PRIMARY]


/***** CREATE LOG TABLE *****/
CREATE TABLE [SUREData_Log](
	[SEQNO] [int] NOT NULL,
	[INTIME] [char](14) NOT NULL,
	[USERCODE] [char](30) NOT NULL,
	[REQNAME] [varchar](32) NULL,
	[REQPHONE] [varchar](20) NULL,
	[CALLNAME] [varchar](32) NULL,
	[COUNTRY] [varchar](10) NULL,
	[CALLPHONE] [varchar](20) NOT NULL,
	[SUBJECT] [varchar](120) NULL,
	[MSG] [varchar](4000) NOT NULL,
	[REQTIME] [char](14) NOT NULL,
	[SENTTIME] [char](14) NULL,
	[RECVTIME] [char](14) NULL,
	[RESULT] [char](1) NOT NULL,
	[ERRCODE] [int] NULL,
	[KIND] [char](1) NOT NULL,
	[DEPTCODE] [char](30) NOT NULL,
	[FKCONTENT] [int] NULL,
	[BATCHFLAG] [int] NOT NULL,
	[RETRY] [int] NOT NULL DEFAULT (0),
	[TEMPLATECODE] [char](14)
)


/***** CREATE INDEX *****/
CREATE NONCLUSTERED INDEX [IX_SUREData] ON [SUREData] 
(
	[RESULT] ASC,
	[KIND] ASC
) ON [PRIMARY]

