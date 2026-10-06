# Regular Expression Test Cases — VitaSafe

Run registration tests through `register.php`. For each case, use a fresh email unless the purpose is to test duplicate-email handling.

## Name pattern
Pattern used by PHP: `^[\p{L}][\p{L} .'-]{1,49}$` with Unicode mode.

| ID | Input | Expected | Reason |
|---|---|---|---|
| N01 | `Asha Patil` | Pass | Letters and space |
| N02 | `Mary-Jane` | Pass | Hyphen allowed |
| N03 | `O'Neil` | Pass | Apostrophe allowed |
| N04 | `李小明` | Pass | Unicode letters supported |
| N05 | `A` | Fail | Fewer than 2 characters |
| N06 | ` Asha` | Fail | First character cannot be a space |
| N07 | `Asha123` | Fail | Digits not allowed |
| N08 | `<script>` | Fail | Invalid characters; output is escaped regardless |

## Password pattern
Pattern: `^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,72}$`

| ID | Input | Expected | Reason |
|---|---|---|---|
| P01 | `Health@2026` | Pass | Mixed case, digit, special character |
| P02 | `health@2026` | Fail | No uppercase |
| P03 | `HEALTH@2026` | Fail | No lowercase |
| P04 | `Health@word` | Fail | No digit |
| P05 | `Health2026` | Fail | No special character |
| P06 | `Aa1@xyz` | Fail | Fewer than 8 characters |
| P07 | `Aa1@abcd` | Pass | Minimum 8 characters |
| P08 | `Aa1@` + 69 more characters | Fail | Longer than 72 characters |

## Email validation
Email is validated with PHP `filter_var(..., FILTER_VALIDATE_EMAIL)` rather than a fragile hand-written email regex.

| ID | Input | Expected |
|---|---|---|
| E01 | `asha@example.com` | Pass |
| E02 | `name.surname+test@example.co.in` | Pass |
| E03 | `plainaddress` | Fail |
| E04 | `name@` | Fail |
| E05 | `@example.com` | Fail |
| E06 | `name example@example.com` | Fail |

## Comment validation
| ID | Input | Expected | Reason |
|---|---|---|---|
| C01 | `Helpful information.` | Pass | Valid length |
| C02 | `ok` | Fail | Fewer than 3 characters |
| C03 | Empty input | Fail | Required |
| C04 | 1001 characters | Fail | More than 1000 characters |
| C05 | `See https://example.com` | Fail | Links disabled by project rule |
| C06 | `<script>alert(1)</script>` | Stored as text and escaped on display | XSS defense |

## How to document results
Add columns `Actual result`, `Pass/Fail`, `Screenshot/Remark` to your report. Test both browser-side validation and server-side validation (disable JavaScript or send invalid POST data). Server-side validation must still reject invalid data.
