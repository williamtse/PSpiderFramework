/**
 * Database schema required by yii2-admin.
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 2.5
 */

drop table if exists `zlk_area`;
drop table if exists `zlk_country`;
drop table if exists `zlk_league`;
create table `zlk_area`
(
    id  int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `AreaId` SMALLINT(3) NOT NULL,
    `Sport` varchar(4) NOT NULL comment '类型：ft-足球，bk-篮球',
    `Name` VARCHAR(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 comment='赛事地区';

INSERT INTO zlk_area (AreaId, Sport, Name) VALUES
(1,'ft','欧洲'),(2,'ft','美洲'),(3,'ft','亚洲'),(4,'ft','大洋洲'),
(5,'ft','非洲');

create TABLE zlk_country(
  id  int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CountryId` int(4) NOT NULL,
  `Sport` varchar(4) NOT NULL comment '类型：ft-足球，bk-篮球',
  Name VARCHAR(30) NOT NULL,
  AreaId INT(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment='赛事国家';

CREATE TABLE zlk_league(
  id  int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  LeagueId INT(11) NOT NULL,
  Sport  varchar(4) NOT NULL comment '类型：ft-足球，bk-篮球',
  Name VARCHAR(60) NOT NULL,
  Color VARCHAR(16),
  CountryId INT(4) NOT NULL,
  Type INT(6) NOT NULL comment '类型：1-联赛，2-杯赛'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment='赛事联赛';

DROP TABLE IF EXISTS `zlk_ft_games`;
create table zlk_ft_games
(
	id int auto_increment primary key,
	start_time int null,
	ended tinyint(1) default '0' not null,
	status smallint(2) null,
	`show` tinyint(1) default '1' not null,
	league_id int null,
	haftime int null,
	hrank varchar(255) null,
	crank varchar(255) null,
	hteam_id int null,
	cteam_id int null,
	js_open tinyint(1) default '0' not null comment '开启竞彩玩法',
	asia_open tinyint(1) default '0' not null comment '开启亚盘玩法',
	real_time int null comment '比赛实际开始时间',
	zhibo tinyint(1) default '0' not null comment '是否有直播',
  	Season VARCHAR(50) NOT NULL COMMENT '赛季',
  	Turn SMALLINT(3) NOT NULL COMMENT '轮次',
	`Group` VARCHAR(2) COMMENT '分组赛的组别A、B、C...'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment='足球赛程';

alter table zlk_ft_games ADD COLUMN `GameTime` int(11) NOT  NULL COMMENT '开始比赛时间';

CREATE TABLE zlk_turns(
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  LeagueId int(11) NOT NULL COMMENT '杯赛id',
  TurnId int(11) NOT NULL COMMENT '轮次ID',
  Season VARCHAR(60) NOT NULL COMMENT '赛季',
  Name_zh VARCHAR(30) NOT NULL COMMENT '轮次名称',
  Name_tw VARCHAR(30) COMMENT '繁体',
  Name_en VARCHAR(30) COMMENT '英文',
  GroupCount SMALLINT(2) NOT NULL DEFAULT 0 COMMENT '有几组，一般是分组赛时',
  IsFinal BOOLEAN NOT NULL DEFAULT 0 COMMENT '是否是总决赛',
  IsTurn BOOLEAN NOT NULL DEFAULT 1 COMMENT '是否是0轮次'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment='赛制-轮次';

#球队
DROP TABLE IF EXISTS `zlk_team`;
CREATE TABLE `zlk_team`(
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  TeamId INT(11) NOT NULL COMMENT '球队ID',
  Sport VARCHAR(4) NOT NULL COMMENT '赛事类型 ft-足球 bk-篮球',
  Name_zh VARCHAR(60) NOT NULL COMMENT '简体中文名称',
  Name_tw VARCHAR(60)  COMMENT '繁体中文名称',
  Name_en VARCHAR(60) COMMENT '英文名称',
  Img VARCHAR(255) COMMENT '队旗',
  created_at int(11),
  updated_at int(11)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 comment='资料库-球队';

DROP TABLE IF EXISTS `zlk_cup_kind`;
CREATE TABLE `zlk_cup_kind`(
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	TrunId INT(11) NOT NULL COMMENT '轮次ID',
	Season VARCHAR(30) NOT NULL COMMENT '赛季',
	LeagueId int(11) NOT NULL COMMENT '赛事ID',
	orderNum tinyint(3) NOT NULL COMMENT '排序数字',
	Name_zh VARCHAR(40) NOT NULL COMMENT '中文名称',
	Name_tw VARCHAR(40),
	Name_en VARCHAR(60),
	GroupCount tinyint(2) NOT NULL DEFAULT 0 COMMENT '组数',
	MakeItTow BOOLEAN NOT NULL DEFAULT 0 COMMENT 'true-两场比赛一组显示的方式'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment='资料库-杯赛轮次类型';

DROP TABLE IF EXISTS `zlk_group_score`;
CREATE TABLE `zlk_group_score`(
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	Season VARCHAR(30) NOT NULL COMMENT '赛季',
	LeagueId INT(11) NOT NULL COMMENT '赛事ID',
	TurnId INT(11) NOT NULL COMMENT '轮次ID',
	`Group` VARCHAR(1) NOT NULL COMMENT '分组赛的组别A、B、C...',
	TeamId INT(11) NOT NULL COMMENT '球队id',
	Rank tinyint(2) NOT NULL COMMENT '小组排名',
	Total tinyint(3) NOT NULL COMMENT '比赛总场次',
	Win tinyint(2) NOT NULL COMMENT '胜场',
	Defeat tinyint(2) NOT NULL COMMENT '败场',
	Gain tinyint(2) NOT NULL COMMENT '总进球',
	Lose tinyint(2) NOT NULL COMMENT '失球',
	Clean tinyint(2) NOT NULL COMMENT '净胜球',
	Score tinyint(2) NOT NULL COMMENT '小组积分'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment='分组赛积分榜';
