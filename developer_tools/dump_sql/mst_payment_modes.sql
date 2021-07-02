INSERT INTO "mst_payment_modes" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (1, 1, 1, NULL, '2016-6-30 16:57:44', '2016-6-30 16:57:44', NULL, 'Cash', 1);
INSERT INTO "mst_payment_modes" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (2, 1, 1, NULL, '2016-6-30 16:57:49', '2016-6-30 16:57:49', NULL, 'Finance', 2);
INSERT INTO "mst_payment_modes" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (3, 1, 1, NULL, '2016-7-12 16:29:41', '2016-7-12 16:44:29', NULL, 'Exchange', 3);

ALTER SEQUENCE mst_payment_modes_id_seq RESTART WITH 4;