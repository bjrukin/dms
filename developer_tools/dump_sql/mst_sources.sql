INSERT INTO "mst_sources" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (1, 1, 1, NULL, '2016-6-30 17:02:09', '2016-6-30 17:02:09', NULL, 'Walk-In', 1);
INSERT INTO "mst_sources" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (2, 1, 1, NULL, '2016-6-30 17:02:15', '2016-6-30 17:02:15', NULL, 'Generated', 2);
INSERT INTO "mst_sources" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (3, 1, 1, NULL, '2016-6-30 17:02:24', '2016-7-12 16:44:37', NULL, 'Referral', 3);

ALTER SEQUENCE mst_sources_id_seq RESTART WITH 4;