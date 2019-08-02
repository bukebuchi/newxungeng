CREATE TABLE IF NOT EXISTS `__PREFIX__flow_instance` (
  `id` char(36) NOT NULL,
  `originator` char(36) NOT NULL,
  `scheme` char(36) NOT NULL,
  `createtime` datetime DEFAULT NULL,
  `instancestatus` int(11) NOT NULL COMMENT '0 草稿1 进行中 2 完成 3 取消',
  `bizobjectid` char(36) DEFAULT NULL,
  `instancecode` varchar(255) DEFAULT NULL,
  `completedtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='流程实例';

--
-- 表的结构 `__PREFIX__flow_scheme`
--
CREATE TABLE IF NOT EXISTS `__PREFIX__flow_scheme` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `flowcode` varchar(255) DEFAULT NULL,
  `flowname` varchar(255) DEFAULT NULL,
  `flowtype` varchar(255) DEFAULT NULL,
  `flowversion` varchar(255) DEFAULT NULL,
  `flowcanuser` varchar(255) DEFAULT NULL,
  `flowcontent` longtext,
  `frmcode` varchar(255) DEFAULT NULL,
  `frmtype` varchar(255) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL,
  `createuser` varchar(255) DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `updateuser` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `bizscheme` varchar(255) DEFAULT '',
  `isenable` tinyint(1) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 COMMENT='分组管理';

--
-- 表的结构 `__PREFIX__flow_task`
--
CREATE TABLE IF NOT EXISTS `__PREFIX__flow_task` (
  `id` char(36) NOT NULL COMMENT '主键',
  `previd` int(11) DEFAULT NULL,
  `prevstepid` int(11) DEFAULT NULL,
  `receiveid` char(36) DEFAULT NULL,
  `stepid` varchar(255) DEFAULT NULL,
  `flowid` int(11) DEFAULT NULL,
  `stepname` varchar(255) DEFAULT NULL,
  `instanceid` char(36) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `senderid` int(11) DEFAULT NULL,
  `opentime` datetime DEFAULT NULL,
  `completedtime` datetime DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `isSign` varchar(255) DEFAULT NULL,
  `status` int(10) DEFAULT NULL COMMENT '状态',
  `note` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='流程任务';

--
-- 替换视图以便查看 `__PREFIX__view_instance`
--
DROP TABLE IF EXISTS `__PREFIX__view_instance`;
CREATE TABLE IF NOT EXISTS `__PREFIX__view_instance` (
`id` char(36)
,`originator` char(36)
,`scheme` char(36)
,`createtime` datetime
,`instancestatus` int(11)
,`bizobjectid` char(36)
,`instancecode` varchar(255)
,`completedtime` datetime
,`nickname` varchar(50)
,`flowname` varchar(255)
);
-- --------------------------------------------------------

--
-- 替换视图以便查看 `__PREFIX__view_workitem`
--
DROP TABLE IF EXISTS `__PREFIX__view_workitem`;
CREATE TABLE IF NOT EXISTS `__PREFIX__view_workitem` (
`instancestatus` int(11)
,`instancecode` varchar(255)
,`bizobjectid` char(36)
,`bizscheme` varchar(255)
,`receivename` varchar(50)
,`flowname` varchar(255)
,`flowcode` varchar(255)
,`originator` char(36)
,`nickname` varchar(50)
,`id` char(36)
,`previd` int(11)
,`prevstepid` int(11)
,`receiveid` char(36)
,`stepid` varchar(255)
,`flowid` int(11)
,`stepname` varchar(255)
,`instanceid` char(36)
,`groupid` int(11)
,`type` varchar(255)
,`tittle` varchar(255)
,`senderid` int(11)
,`opentime` datetime
,`completedtime` datetime
,`comment` varchar(255)
,`isSign` varchar(255)
,`status` int(10)
,`note` varchar(255)
,`sort` varchar(255)
,`createtime` datetime
);
-- --------------------------------------------------------

--
-- 视图结构 `__PREFIX__view_instance`
--
DROP TABLE IF EXISTS `__PREFIX__view_instance`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `__PREFIX__view_instance` AS select `a`.`id` AS `id`,`a`.`originator` AS `originator`,`a`.`scheme` AS `scheme`,`a`.`createtime` AS `createtime`,`a`.`instancestatus` AS `instancestatus`,`a`.`bizobjectid` AS `bizobjectid`,`a`.`instancecode` AS `instancecode`,`a`.`completedtime` AS `completedtime`,`b`.`nickname` AS `nickname`,`c`.`flowname` AS `flowname` from ((`__PREFIX__flow_instance` `a` left join `__PREFIX__admin` `b` on((`a`.`originator` = `b`.`id`))) left join `__PREFIX__flow_scheme` `c` on((`a`.`scheme` = `c`.`id`)));

-- --------------------------------------------------------

--
-- 视图结构 `__PREFIX__view_workitem`
--
DROP TABLE IF EXISTS `__PREFIX__view_workitem`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `__PREFIX__view_workitem` AS select `b`.`instancestatus` AS `instancestatus`,`b`.`instancecode` AS `instancecode`,`b`.`bizobjectid` AS `bizobjectid`,`c`.`bizscheme` AS `bizscheme`,`e`.`nickname` AS `receivename`,`c`.`flowname` AS `flowname`,`c`.`flowcode` AS `flowcode`,`b`.`originator` AS `originator`,`d`.`nickname` AS `nickname`,`a`.`id` AS `id`,`a`.`previd` AS `previd`,`a`.`prevstepid` AS `prevstepid`,`a`.`receiveid` AS `receiveid`,`a`.`stepid` AS `stepid`,`a`.`flowid` AS `flowid`,`a`.`stepname` AS `stepname`,`a`.`instanceid` AS `instanceid`,`a`.`groupid` AS `groupid`,`a`.`type` AS `type`,`a`.`tittle` AS `tittle`,`a`.`senderid` AS `senderid`,`a`.`opentime` AS `opentime`,`a`.`completedtime` AS `completedtime`,`a`.`comment` AS `comment`,`a`.`isSign` AS `isSign`,`a`.`status` AS `status`,`a`.`note` AS `note`,`a`.`sort` AS `sort`,`a`.`createtime` AS `createtime` from ((((`__PREFIX__flow_instance` `b` left join `__PREFIX__flow_task` `a` on((`a`.`instanceid` = `b`.`id`))) left join `__PREFIX__flow_scheme` `c` on((`b`.`scheme` = `c`.`id`))) left join `__PREFIX__admin` `d` on((`b`.`originator` = `d`.`id`))) left join `__PREFIX__admin` `e` on((`a`.`receiveid` = `e`.`id`)));

--
-- 表的结构 `__PREFIX__flow_leave`
--

CREATE TABLE IF NOT EXISTS `__PREFIX__flow_leave` (
  `id` char(36) NOT NULL,
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `content` varchar(255) DEFAULT '' COMMENT '请假原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='请假表';

BEGIN;

INSERT INTO `__PREFIX__flow_scheme` (`id`, `flowcode`, `flowname`, `flowtype`, `flowversion`, `flowcanuser`, `flowcontent`, `frmcode`, `frmtype`, `weight`, `description`, `createtime`, `createuser`, `updatetime`, `updateuser`, `url`, `bizscheme`, `isenable`) VALUES
(33, 'leave', '请假流程', NULL, NULL, NULL, '{"nodes":[{"left":85,"type":"start","removable":false,"name":"开始","className":"node-start","id":"1523002631942","positionX":150,"positionY":20,"alt":true,"setInfo":{"nodeName":"开始"}},{"left":81,"top":159,"type":"node","id":"1523002636766","name":"组别领导","positionX":140,"positionY":120,"className":"node-process","removable":true,"setInfo":{"NodeDesignateData":{"users":["1"],"role":[""],"org":[]},"nodeName":"组别领导","nodeCode":"node_2","nodeRejectType":"0","nodeDesignate":"user","Taged":1,"UserId":"00000000-0000-0000-0000-000000000000","UserName":"超级管理员","Description":"自己处理一下","TagedTime":"2018-04-06 16:22","method":"admin","users":"admin2899999"}},{"className":"node-end","top":368,"type":"end","name":"结束","id":"1523002639310","positionX":150,"positionY":410,"removable":false,"setInfo":{"NodeDesignateData":{"users":["49df1602-f5f3-4d52-afb7-3802da619558"],"role":[],"org":[]},"nodeName":"结束","nodeCode":"node_3","nodeRejectType":"0","nodeDesignate":"SPECIAL_USER"}},{"name":"审批节点","procId":"0","type":"node","username":"aaaaa","desc":"审批节点","nodeType":1,"id":"flow-chart-node01560705015364","setInfo":{"nodeName":"审批节点","NodeDesignateData":{"users":["1"],"role":[""]},"nodeDesignate":"user"},"positionX":420,"positionY":210,"className":"node-process","removable":true}],"lines":[{"id":"con_19","from":"1523002631942","to":"1523002636766"},{"id":"con_24","from":"1523002636766","to":"1523002639310"},{"id":"con_29","from":"1523002636766","to":"flow-chart-node01560705015364"},{"id":"con_34","from":"flow-chart-node01560705015364","to":"1523002639310"}]}', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL, '__PREFIX__flow_leave', 1);
-- --------------------------------------------------------
COMMIT;

BEGIN;

INSERT INTO `__PREFIX__flow_leave` (`id`, `start_time`, `end_time`, `content`) VALUES
('0d2c5685-7403-48cf-91e1-00975cf143dd', '2019-06-09 10:50:38', '2019-06-09 10:50:38', '生病'),
('77b64a55-5ef4-4703-bf3d-eac67fbcb8d7', '2019-06-09 10:49:09', '2019-06-09 10:49:09', '生病');
COMMIT;
