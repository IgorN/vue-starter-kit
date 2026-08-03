## Skill: secret leakage gate
Treat any literal credential introduced in the diff as CRITICAL: `sk_live_` /
`sk_test_` keys, `service_role` keys, bearer tokens, passwords, `-----BEGIN ... PRIVATE KEY-----`,
and connection strings with embedded credentials. Require it be moved to a secret
store and rotated. Do NOT flag obvious placeholders (`xxx`, `<your-key>`, `example`).