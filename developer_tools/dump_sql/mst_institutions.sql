INSERT INTO "mst_institutions" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (1, 1, 1, NULL, '2016-7-13 12:12:54', '2016-7-13 12:12:54', NULL, 'Bank', 1);
INSERT INTO "mst_institutions" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (2, 1, 1, NULL, '2016-7-13 12:13:01', '2016-7-13 12:13:01', NULL, 'Education', 2);
INSERT INTO "mst_institutions" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (3, 1, 1, NULL, '2016-7-13 12:13:10', '2016-7-13 12:13:10', NULL, 'Others', 3);

ALTER SEQUENCE mst_institutions_id_seq RESTART WITH 4;